@extends('../layouts.admin')
@section('sub-title','NET PROFIT')
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
        <h3 class="mb-0 text-uppercase" id="titletable">NET PROFIT REPORTS</h3>
      </div>
      <div class="col-8 mx-auto row">
        <div class="col">
        <input type="date" id="df" class="form-control">
        </div>
        <div class="col">
        <input type="date" id="dt" class="form-control">
        
        </div>
        <div class="col">
        <button type="button" id="submit" class="text-uppercase btn btn-primary">SUBMIT</button>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table align-items-center table-flush datatable display" cellspacing="0" width="100%">
      <tbody class="text-uppercase font-weight-bold">
              <tr>
                  <td>
                      EXPENSES
                  </td>
                  <td class="date_from">
                      {{$df}}
                  </td>
                  <td  class="date_to">
                       {{$dt}}
                  </td>
                  <td>
                     
                  </td>
                  <td>
                      TOTAL EXPENSES
                  </td>
                  <td>
                      {{$buying ?? 0}}
                  </td>
                  <td>
                      
                  </td>
              </tr>
              <tr>
                  <td>
                      INCOME
                  </td>
                  <td class="date_from">
                        {{$df}}
                  </td>
                  <td  class="date_to">
                  {{$dt}}
                  </td>
                  <td>
                     
                  </td>
                  <td>
                      TOTAL INCOME
                  </td>
                  <td>
                    {{$selling ?? 0}}
                  </td>
                  <td>
                      
                  </td>
              </tr>
              <tr>
                  <td>
                      
                  </td>
                  <td>
                      
                  </td>
                  <td>
                     
                  </td>
                  <td>
                     
                  </td>
                  <td>
                      TOTAL PROFIT
                  </td>
                  <td>
                    {{$total ?? 0}}
                  </td>
                  <td>
                      
                  </td>
              </tr>
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


$(document).on('click', '#submit', function(){
    var df = $('#df').val();
    var dt = $('#dt').val();
    if(df !== '' && dt !== ''){
      window.location.href = "/admin/net_profit/fbd/"+df+"/"+dt+"";
    }else{
      alert('Select a date')
    }
    
    
});

</script>
@endsection
