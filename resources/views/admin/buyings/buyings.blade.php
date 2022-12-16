@extends('../layouts.admin')
@section('sub-title','BUYINGS')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>


<div class="mt--6 card m-2">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0 text-uppercase" id="titletable">MANAGE BUYING ITEMS</h3>
      </div>
      <div class="col text-right">
        @if($transaction_id == 0)
            <button type="button" id="create_record" class="text-uppercase create_record btn btn-primary">NEW BUYING</button>
        @endif
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable display" cellspacing="0" width="100%">
      <thead class="thead-white">
        <tr>
          <th>Actions</th>
          <th>SELLER ID</th>
          <th>SELLER NAME</th>
          <th>ITEM TYPE</th>
          <th>ITEM NAME</th>
          <th>QTY</th>
          <th>UNIT</th>
          <th>BUYING PRICE</th>
          <th>AMOUNT</th>
          <th>Created At</th>
          
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($buyings as $buying)
              <tr>
                  <td>
                    @if($buying->status == "PENDING")
                      <button type="button" name="edit" edit="{{  $buying->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                      <button type="button" name="remove" remove="{{  $buying->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    @endif
                  </td>
                  <td>
                      {{  $buying->seller->id ?? '' }}
                  </td>
                  <td>
                      {{  $buying->seller->name ?? '' }}
                  </td>
                  <td>
                      {{  $buying->item->type->title ?? '' }}
                  </td>
                  <td>
                    {{  $buying->item->title ?? '' }}
                  </td>
                  <td>
                      {{  $buying->qty ?? '' }}
                  </td>
                  <td>
                  {{  $buying->item->unit->title ?? '' }}
                  </td>
                  <td>
                      {{  $buying->price ?? '' }}
                  </td>
                  <td>
                      {{  $buying->amount ?? '' }}
                  </td>
                  <td>
                      {{ $buying->created_at->format('M j , Y h:i A') }}
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer border-0">
    <div class="row align-items-center">
      <div class="col text-right">
       @if($transaction_id == 0)
            <button type="button" id="saveTransaction" class="text-uppercase create_record btn btn-success">SAVE THIS TRANSACTION</button>
        @endif
        
      </div>
    </div>
  </div>
</div>


@section('footer')
    @include('../partials.footer')
@endsection
<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title text-white text-uppercase font-weight-bold">BUYING DETAILS</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >SELLER:<span class="text-danger">*</span></label>
                            <select name="seller_id" id="seller_id" class="form-control select2">
                                @foreach ($sellers as $seller)
                                    <option value="{{$seller->id}}">{{$seller->name}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-seller_id"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >ITEM:<span class="text-danger">*</span></label>
                            <select name="item_id" id="item_id" class="form-control select2">
                                @foreach ($items as $item)
                                    <option value="{{$item->id}}">{{$item->title}} / {{$item->unit->title}} PRICE: {{$item->price}} STOCK: {{$item->stock}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-item_id"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >QTY:<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" name="qty" id="qty">
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-qty"></strong>
                            </span>
                        </div>
                    </div>
                   
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Save" />
                </div>
        
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')
<script>

$(function () {
    $('.datatable').DataTable({
        bDestroy: true,
        pageLength: 100,
    });
});

$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this item?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/buyings/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('#titletable').text('Loading...');
                      },
                      success:function(data){
                          if(data.success){
                            $.confirm({
                                title: 'Confirmation',
                                content: data.success,
                                type: 'green',
                                buttons: {
                                        confirm: {
                                            text: 'confirm',
                                            btnClass: 'btn-blue',
                                            keys: ['enter', 'shift'],
                                            action: function(){
                                                location.reload();
                                            }
                                        },
                                        
                                    }
                                });
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });

});

$(document).on('click', '.edit', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/buyings/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            
        },
        success:function(data){
            if($('#action').val() == 'Edit'){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Update");
            }else{
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Submit");
            }
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                }
                if(key == 'seller_id'){
                    $("#seller_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
                if(key == 'item_id'){
                    $("#item_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
            })
            $('#hidden_id').val(id);
            $('#action_button').val('Update');
            $('#action').val('Edit');
        }
    })
});

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#action_button').val('Submit');
    $('#action').val('Add');
    $('#form_result').html('');
    
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.buyings.store') }}";
    var type = "POST";

    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "/admin/buyings/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
        },
        success:function(data){
            if($('#action').val() == 'Edit'){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Update");
            }else{
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Submit");
            }
            
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $.confirm({
                    title: 'Confirmation',
                    content: data.success,
                    type: 'green',
                    buttons: {
                            confirm: {
                                text: 'confirm',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    location.reload();
                                }
                            },
                            
                        }
                    });
            }
           
        }
    });
});


$(document).on('click', '#saveTransaction', function(){
   $.confirm({
      title: 'Confirmation',
      content: 'You really want to save this transaction?',
      type: 'green',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/buyings/saveTransaction",
                      method:'GET',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('#titletable').text('Loading...');
                      },
                      success:function(data){
                          if(data.success){
                            $.confirm({
                                title: 'Confirmation',
                                content: data.success,
                                type: 'green',
                                buttons: {
                                        confirm: {
                                            text: 'confirm',
                                            btnClass: 'btn-blue',
                                            keys: ['enter', 'shift'],
                                            action: function(){
                                                location.reload();
                                            }
                                        },
                                        
                                    }
                                });
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });
    
});


</script>
@endsection
