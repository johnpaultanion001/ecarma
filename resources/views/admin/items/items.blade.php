@extends('../layouts.admin')
@section('sub-title','ITEMS')
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
        <h3 class="mb-0 text-uppercase" id="titletable">MANAGE ITEMS</h3>
      </div>
      <div class="col text-right">
        <button type="button" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Item</button>
        <a href="/admin/items/manages/types" target="_black" class="text-uppercase btn btn-sm btn-success">Manage Types</a>
        <a href="/admin/items/manages/units" target="_black" class="text-uppercase btn btn-sm btn-info">Manage Units</a>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable display" cellspacing="0" width="100%">
      <thead class="thead-white">
        <tr>
          <th>Actions</th>
          <th>Title</th>
          <th>Type</th>
          <th>Buying Price</th>
          <th>Selling Price</th>
          <th>Unit</th>
          <th>Description</th>
          <th>Created At</th>
          
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($items as $item)
              <tr>
                  <td>
                      <button type="button" name="edit" edit="{{  $item->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                      <button type="button" name="remove" remove="{{  $item->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </td>
                  <td>
                      {{  $item->title ?? '' }}
                  </td>
                  <td>
                      {{  $item->type->title ?? '' }}
                  </td>
                  <td>
                      {{  number_format($item->buying_price , 2, '.', ',') }}
                  </td>
                  <td>
                      {{  number_format($item->selling_price , 2, '.', ',') }}
                  </td>
                  <td>
                      {{  $item->unit->title ?? '' }}
                  </td>
                  <td>
                      {{  $item->description ?? '' }}
                  </td>
                  <td>
                      {{ $item->created_at->format('M j , Y h:i A') }}
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
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
                    <p class="modal-title text-white text-uppercase font-weight-bold">Modal Heading</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Title:<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" />
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-title"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Type:<span class="text-danger">*</span></label>
                            <select name="type_id" id="type_id" class="form-control select2">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-type_id"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Buying Price:<span class="text-danger">*</span></label>
                            <input type="number" name="buying_price" id="buying_price" class="form-control" step="any"/>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-buying_price"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Selling Price:<span class="text-danger">*</span></label>
                            <input type="number" name="selling_price" id="selling_price" class="form-control" step="any"/>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-selling_price"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Unit:<span class="text-danger">*</span></label>
                            <select name="unit_id" id="unit_id" class="form-control select2">
                                @foreach ($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->title}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-unit_id"></strong>
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Description:</label>
                            <textarea name="description" id="description" class="form-control "></textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-description"></strong>
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
                      url:"/admin/items/"+id,
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
    $('.modal-title').text('Edit item');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/items/"+id+"/edit",
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
                if(key == 'type_id'){
                    $("#type_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
                if(key == 'unit_id'){
                    $("#unit_id").select2("trigger", "select", {
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
    $('.modal-title').text('Add New item');
    $('#action_button').val('Submit');
    $('#action').val('Add');
    $('#form_result').html('');
    
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.items.store') }}";
    var type = "POST";

    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "items/" + id;
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

var manage = '';

$(document).on('click', '.btn_manage', function(){
        manage = $(this).attr('manage');
        $('#manageModal').modal('show');
        $('.modal-title').text(manage == 'types' ? 'Manage Types':'Manage Units');

        var action_url = "/admin/items/manages/"+manage;

        $.ajax({
            url : action_url,
            dataType:"json",
            beforeSend:function(){
                $("#action_button_manage").attr("disabled", true);
                $("#action_button_manage").val("Loading");
            },
            success:function(data){
                $("#action_button_manage").attr("disabled", false);
                $("#action_button_manage").val("Submit");

                var manage = "";
                console.log(data.results)
                if(data.results){
                    $.each(data.results, function(key,value){
                        manage += '<div class="parentContainer mt-2">';
                            manage += '<div class="row childrenContainer">';
                                manage += '<div class="col-8">';
                                    manage += '<input type="text" name="title[]" class="form-control" value="'+value.title+'" required/>';
                                manage += '</div>';
                                manage += '<div class="col-4">';
                                    if (key === 0) {
                                        manage +=  '<button type="button" name="addParent" id="addParent" class="addParent btn btn-success">';            
                                            manage +=  '<i class="fas fa-plus-circle"></i>';     
                                        manage +=  '</button>';
                                    }else{
                                        manage += '<button type="button" class="btn btn-danger removeParent">';
                                            manage += '<i class="fa fa-minus-circle" aria-hidden="true"></i>';
                                        manage += '</button>';
                                    }
                                manage += '</div>';
                            manage += '</div>';
                        manage += '</div>';
                    });
                    $('#section_manage').empty().append(manage);
                } 
            }
        })

});

$('#myManage').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var action_url = "/admin/items/manages/"+manage;
        var method = "POST";

        $.ajax({
            url: action_url,
            method: method,
            data: $(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $("#action_button").attr("disabled", true);
                $("#action_button").val("Submitting");
            },
            success:function(data){
                $("#action_button").attr("disabled", false);
                $("#action_button").val("Submit");

            if(data.success){
                    $.confirm({
                        title: data.success,
                        content: "",
                        type: 'green',
                        buttons: {
                            confirm: {
                                text: '',
                                btnClass: 'btn-green',
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

$(document).on('click', '.addParent', function () {
        var manage = '';
        manage = ` <div class="parentContainer mt-2">
                        <div class="row childrenContainer">
                            <div class="col-8">
                                <input type="text"  name="title[]" class="form-control" required/>
                            </div>
                            <div class="col-4">
                                <button type="button" class="removeParent btn btn-danger">            
                                        <i class="fa fa-minus-circle" aria-hidden="true"></i>        
                                </button>
                            </div>
                        </div>
                    </div> `

        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .append(manage);
});

$(document).on('click', '.removeParent', function () {
    $(this).closest('#inputFormRow').remove();
    $(this).parent().parent().parent().remove();
});

</script>
@endsection
