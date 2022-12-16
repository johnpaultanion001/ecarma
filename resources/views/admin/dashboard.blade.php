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
                            <span class="h2 font-weight-bold mb-0">
                            0
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
<script>

 

</script>
@endsection




