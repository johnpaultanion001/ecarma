<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="{{ route("admin.dashboard") }}">
          <!-- <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->

          <h3 class="text-primary">{{ trans('panel.site_title') }}</h3>
          <hr class="my-1 bg-primary">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}" href="{{ route("admin.dashboard") }}">
                  <i class="ni ni-tv-2 "></i>
                  <span class="nav-link-text text-uppercase">Dashboard</span>
                </a>
              </li>
           
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/items') ? 'active' : '' }}" href="{{ route("admin.items.index") }}">
                  <i class="ni ni-bullet-list-67"></i>
                  <span class="nav-link-text text-uppercase">Items</span>
                </a>
              </li>
          </ul>
 
          <hr class="my-3 bg-pink">
            <h6 class="navbar-heading p-0 text-muted">
              <span class="docs-normal text-uppercase">Customer</span>
            </h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/sellers') || request()->is('admin/sellers/*') ? 'active' : '' }}" href="{{ route("admin.sellers.index") }}">
                    
                    <i class="ni ni-bullet-list-67 text-pink"></i>
                    <span class="nav-link-text text-uppercase">Walk-in Sellers</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/buyers') || request()->is('admin/buyers/*') ? 'active' : '' }}" href="{{ route("admin.buyers.index") }}">
                    <i class="ni ni-building text-pink "></i>
                    <span class="nav-link-text text-uppercase">Company Buyers</span>
                  </a>
                </li>
            </ul>


            <hr class="my-3 bg-info">
            <h6 class="navbar-heading p-0 text-muted">
              <span class="docs-normal text-uppercase">TRANSACTIONS</span>
            </h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}" href="/admin/transactions">
                     <i class="ni ni-bullet-list-67 text-info"></i>
                    <span class="nav-link-text text-uppercase">TRANSACTIONS</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/buyings')  || request()->is('admin/buyings/*') ? 'active' : '' }}" href="/admin/buyings/0/buy">
                   <i class="ni ni-bullet-list-67 text-info"></i>
                    <span class="nav-link-text text-uppercase">buyings</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/sellings') || request()->is('admin/sellings/*') ? 'active' : '' }}" href="/admin/sellings/0/buy">
                    <i class="ni ni-building text-info "></i>
                    <span class="nav-link-text text-uppercase">Sellings</span>
                  </a>
                </li>
            </ul>


            <hr class="my-3 bg-success">
            <h6 class="navbar-heading p-0 text-muted">
              <span class="docs-normal text-uppercase">Other</span>
            </h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/inventories') || request()->is('admin/inventories/*') ? 'active' : '' }}" href="/admin/inventories"> 
                    <i class="ni ni-user-run text-success"></i>
                    <span class="nav-link-text text-uppercase">Inventories</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/buying/expenses/*') ? 'active' : '' }}" href="/admin/buying/expenses/all/all/all">
                    <i class="ni ni-building text-success"></i>
                    <span class="nav-link-text text-uppercase">Expenses</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/selling/income/*') ? 'active' : '' }}" href="/admin/selling/income/all/all/all">
                    <i class="ni ni-building text-success"></i>
                    <span class="nav-link-text text-uppercase">Income</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/net_profit/*') ? 'active' : '' }}" href="/admin/net_profit/all/all/all">
                    <i class="ni ni-building text-success"></i>
                    <span class="nav-link-text text-uppercase">Net Profit</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/items/manages/types') || request()->is('admin/items/manages/types') ? 'active' : '' }}" href="/admin/items/manages/types">
                    <i class="ni ni-bullet-list-67 text-success"></i>
                    <span class="nav-link-text text-uppercase">Manage Types</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('admin/items/manages/units') || request()->is('admin/items/manages/units') ? 'active' : '' }}" href="/admin/items/manages/units">
                    <i class="ni ni-bullet-list-67 text-success"></i>
                    <span class="nav-link-text text-uppercase">Manage Units</span>
                  </a>
                </li>
            </ul>
        </div>

      </div>
    </div>
  </nav>