<div class="card mt--6">
  
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">SALES INVENTORIES</h3> 
              <br>
              <h4 class="mb-0 text-uppercase">PALLETS</h4> 
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush datatable-pallets display table-lg" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Title</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Inventory Amount</th>
                <th scope="col">Updated At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
                @php
                  $total_inv_amt = 0;
                @endphp
                @foreach($pallets as $pallet)
                    @php
                      $total_inv = $pallet->price * $pallet->stock;
                      $total_inv_amt = $total_inv_amt + $total_inv;
                    @endphp
                    <tr>
                      <td>
                      @can('update_sales_inventory')
                          <button type="button" ev_pallet="{{  $pallet->id ?? '' }}"  class="ev_pallet text-uppercase btn btn-info btn-sm">View/Edit</button>
                      @endcan
                      </td>
                      <td>
                          {{  $pallet->title ?? '' }}
                      </td>
                      <td>
                          {{  number_format($pallet->price , 2, '.', ',') }}
                      </td>
                      <td>
                          {{  $pallet->stock ?? '' }}
                      </td>
                      <td>
                          {{  number_format($total_inv , 2, '.', ',') }}
                      </td>
                      <td>
                          {{ $pallet->updated_at->format('M j , Y h:i A') }}
                      </td>
                    </tr>
                @endforeach
                  <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                        Total Inventory Amount:
                      </td>
                      <td>
                        {{  number_format($total_inv_amt , 2, '.', ',') }}
                      </td>
                      <td>
                      </td>
                    </tr>
                    
            </tbody>
          </table>
        </div>
        
        
        <br>
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h4 class="mb-0 text-uppercase">PRODUCTS</h4> 
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush datatable-inventries display table-lg" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">RG ID</th>

                <th scope="col">Product Code</th>
                <th scope="col">Description</th>
                <th scope="col">Size</th>
                <th scope="col">Category</th>
                <th scope="col">Supplier</th>

                <th scope="col">Overall Stock</th>
                <th scope="col">Location Stock</th>
                <th scope="col">Sold</th>

                <th scope="col">Unit Price</th>
                <th scope="col">Inventory Amount</th>
                <th scope="col">Remarks</th>
                <th scope="col">Updated At</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
                @php
                  $total_inv_amt_p = 0;
                @endphp
                @foreach($products as $key => $product)
                    @php
                      $total_inv_p = $product->price * $product->location_products->sum('stock');
                      $total_inv_amt_p = $total_inv_amt_p + $total_inv_p;
                    @endphp
                    <tr data-entry-id="{{ $product->id ?? '' }}">
                    
                      <td>
                      @can('update_sales_inventory')
                          <button type="button" name="ev_product" ev_product="{{  $product->id ?? '' }}"  class="ev_product text-uppercase btn btn-info btn-sm">View/Edit</button>
                      @endcan
                      </td>

                      <td>
                          {{  $product->receiving_good_id ?? '' }}
                      </td>
                      <td>
                          {{  $product->product_code ?? '' }}
                      </td>
                      <td>
                      {{  $product->description ?? '' }}
                      </td>
                      <td>
                          {{  $product->size->title ?? '' }}  {{  $product->size->size ?? '' }}
                      </td>
                      <td>
                          {{  $product->category->name ?? '' }}
                      </td>
                      <td>
                          {{  $product->receiving_good->supplier->name ?? '' }}
                      </td>
                      <td>
                          {{  $product->location_products->sum('stock') ?? ''}}
                      </td>
                      <td>
                        <div style="max-height: 100px; overflow: auto;">
                            @foreach($product->location_products as $lp)
                              {{$lp->location->location_name ?? ''}} ({{$lp->stock ?? ''}}) <br>
                            @endforeach
                        </div>
                      </td>
                      <td>
                          {{  $product->sold ?? '' }}
                      </td>
                      
                     
                      <td>
                          {{  number_format($product->price , 2, '.', ',') }}
                      </td>
                      <td>
                          {{  number_format($total_inv_p , 2, '.', ',') }}
                      </td>
                      
                      <td>
                          {{  $product->product_remarks ?? '' }}
                      </td>
                      <td>
                          {{ $product->updated_at->format('M j , Y h:i A') }}
                      </td>
                      <td>
                          {{ $product->created_at->format('M j , Y h:i A') }}
                      </td>
                    </tr>
                @endforeach
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
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                        Total Inventory Amount:
                      </td>
                      <td>
                        {{  number_format($total_inv_amt_p , 2, '.', ',') }}
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                    </tr>
            </tbody>
          </table>
        </div>
        
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
</div>

<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
    bDestroy: true,
    responsive: true,
    scrollY: 500,
    scrollCollapse: true,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });
  $('.datatable-pallets').DataTable();

  var table = $('.datatable-inventries:not(.ajaxTable)').DataTable({ buttons: dtButtons });
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
  });

 
  
  $('select[name="filter_category"]').on("change", function(event){
    table.columns(8).search( this.value ).draw();
  });

  $('select[name="filter_supplier"]').on('change', function () {
    table.columns(9).search( this.value ).draw();
  });

  $('select[name="filter_size"]').on('change', function () {
    table.columns(7).search( this.value ).draw();
  });

  $('select[name="filter_location"]').on('change', function () {
    table.columns(5).search( this.value ).draw();
  });

    
});

</script>