@extends('../layouts.admin')
@section('sub-title','INCOME')
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
        <h3 class="mb-0 text-uppercase" id="titletable">INCOME</h3>
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
          <th>Company ID</th>
          <th>Company NAME</th>
          <th>ITEM TYPE</th>
          <th>ITEM NAME</th>
          <th>QTY</th>
          <th>UNIT</th>
          <th>BUYING PRICE</th>
          <th>INCOME AMOUNT</th>
          <th>Created At</th>
          
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($sellings as $selling)
              <tr>
                  <td>
                      {{  $selling->buyer->id ?? '' }}
                  </td>
                  <td>
                      {{  $selling->buyer->name ?? '' }}
                  </td>
                  <td>
                      {{  $selling->item->type->title ?? '' }}
                  </td>
                  <td>
                    {{  $selling->item->title ?? '' }}
                  </td>
                  <td>
                      {{  $selling->qty ?? '' }}
                  </td>
                  <td>
                  {{  $selling->item->unit->title ?? '' }}
                  </td>
                  <td>
                      {{  $selling->price ?? '' }}
                  </td>
                  <td>
                      {{  $selling->amount ?? '' }}
                  </td>
                  <td>
                      {{ $selling->created_at->format('M j , Y h:i A') }}
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
  window.location.href = "/admin/selling/income/fbd/"+df+"/"+dt+"";
}else{
  alert('Select a date')
}


});




</script>
@endsection
