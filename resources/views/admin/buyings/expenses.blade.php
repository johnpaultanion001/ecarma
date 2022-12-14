@extends('../layouts.admin')
@section('sub-title','EXPENSES')
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
      <div class="col-4">
        <h3 class="mb-0 text-uppercase" id="titletable">EXPENSES</h3>
      </div>
      <div class="col-8 mx-auto row">
        <div class="col">
        <input type="date" id="df" class="form-control">
        <small>Date From: {{$df ?? ''}}</small>
        </div>
        <div class="col">
        <input type="date" id="dt" class="form-control">
        <small>Date To: {{$dt ?? ''}}</small>
        </div>
        <div class="col">
        <button type="button" id="submit" class="text-uppercase btn btn-primary">SUBMIT</button>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable display" cellspacing="0" width="100%">
      <thead class="thead-white">
        <tr>
          <th>ID</th>
          <th>SELLER ID</th>
          <th>SELLER NAME</th>
          <th>ITEM TYPE</th>
          <th>ITEM NAME</th>
          <th>QTY</th>
          <th>UNIT</th>
          <th>BUYING PRICE</th>
          <th>EXPENSES AMOUNT</th>
          <th>Created At</th>
          
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($buyings as $buying)
              <tr>
                  <td>
                      {{  $buying->id ?? '' }}
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
</div>


@section('footer')
    @include('../partials.footer')
@endsection


@endsection

@section('script')
<script>

$(function () {
    $('.datatable').DataTable({
        bDestroy: true,
        pageLength: 100,
    });
});

$(document).on('click', '#submit', function(){

    var df = $('#df').val();
    var dt = $('#dt').val();

    if(df !== '' && dt !== ''){
      window.location.href = "/admin/buying/expenses/fbd/"+df+"/"+dt+"";
    }else{
      alert('Select a date')
    }

    
});



</script>
@endsection
