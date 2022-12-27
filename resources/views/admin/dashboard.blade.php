@extends('../layouts.admin')
@section('sub-title','DASHBOARD')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
        <div class="row">
          <div class="col-xl-6 col-md-6">
              <div class="card card-dashboard card-stats">
              <!-- Card body -->
                  <div class="card-body">
                      <div class="row mb-4">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Items</h5>
                            <span class="h2 font-weight-bold mb-0">
                            {{$total_items}}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-basket"></i>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-6 col-md-6">
              <div class="card card-dashboard card-stats">
              <!-- Card body -->
                  <div class="card-body">
                      <div class="row mb-4">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Buying</h5>
                            <span class="h2 font-weight-bold mb-0">
                            {{$total_buying->count()}}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-basket"></i>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-6 col-md-6">
              <div class="card card-dashboard card-stats">
              <!-- Card body -->
                  <div class="card-body">
                      <div class="row mb-4">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Selling</h5>
                            <span class="h2 font-weight-bold mb-0">
                            {{$total_selling->count()}}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-basket"></i>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-6 col-md-6">
              <div class="card card-dashboard card-stats">
              <!-- Card body -->
                  <div class="card-body">
                      <div class="row mb-4">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Expenses</h5>
                            <span class="h2 font-weight-bold mb-0">
                            {{$total_buying->sum('amount')}}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-basket"></i>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-6 col-md-6">
              <div class="card card-dashboard card-stats">
              <!-- Card body -->
                  <div class="card-body">
                      <div class="row mb-4">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Incomes</h5>
                            <span class="h2 font-weight-bold mb-0">
                            {{$total_selling->sum('amount')}}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-basket"></i>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-6 col-md-6">
              <div class="card card-dashboard card-stats">
              <!-- Card body -->
                  <div class="card-body">
                      <div class="row mb-4">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Net Profit</h5>
                            @php
                                $total = $total_selling->sum('amount') - $total_buying->sum('amount');
                            @endphp
                            <span class="h2 font-weight-bold mb-0">
                            {{$total ?? 0}}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-basket"></i>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>

        <div class="col-xl-12">
            <div class="card shadow">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h2 class="m-0 font-weight-bold text-primary">SELLING</h2>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chart_selling"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card shadow">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h2 class="m-0 font-weight-bold text-primary">BUYING</h2>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chart_buying"></canvas>
                    </div>
                </div>
            </div>
        </div>
        

        </div>
    </div>
    </div>
</div>
  <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>

$(function(){
      //GETTING DATA FROM THE CONTROLLER
      var selling = JSON.parse(`<?php echo $selling; ?>`);
      var selling_id = $("#chart_selling");
      var buying = JSON.parse(`<?php echo $buying; ?>`);
      var buying_id = $("#chart_buying");
      
      //DATA
      var selling_data = {
        labels: selling.label,
        datasets: [
          {
            label: "AMOUNT:",
            data: selling.data,
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            borderWidth: [1, 1, 1, 1, 1,1,1]
          }
        ]
      };
      var buying_data = {
        labels: buying.label,
        datasets: [
          {
            label: "AMOUNT:",
            data: buying.data,
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            borderWidth: [1, 1, 1, 1, 1,1,1]
          }
        ]
      };
 
      //options
      var options = {
        maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
            },
      };
 
      var selling_chart = new Chart(selling_id, {
        type: "line",
        data: selling_data,
        options: options
      });
      var buying_chart = new Chart(buying_id, {
        type: "line",
        data: buying_data,
        options: options
      });
 
  });
 

</script>
@endsection




