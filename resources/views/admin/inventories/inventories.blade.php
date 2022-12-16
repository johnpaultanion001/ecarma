@extends('../layouts.admin')
@section('sub-title','INVENTORIES')
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
        <h3 class="mb-0 text-uppercase" id="titletable">INVENTORIES</h3>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable display" cellspacing="0" width="100%">
      <thead class="thead-white">
        <tr>
          <th>Title</th>
          <th>Type</th>
          <th>Unit</th>
          <th>Stock</th>
          <th>Status</th>
          
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($items as $item)
              <tr>
                  <td>
                      {{  $item->title ?? '' }}
                  </td>
                  <td>
                      {{  $item->type->title ?? '' }}
                  </td>
                  <td>
                      {{  $item->unit->title ?? '' }}
                  </td>
                  <td>
                      {{  $item->stock ?? '' }}
                  </td>
                  <td>
                      {{  $item->stock > 0 ? 'ACTIVE':'INACTIVE' }}
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
@section('footer')
    @include('../partials.footer')
@endsection

@section('script')
<script>

$(function () {
    $('.datatable').DataTable({
        bDestroy: true,
        pageLength: 100,
    });
});

</script>
@endsection
