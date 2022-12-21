        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/home">
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('admin/home*') ? 'active' : '' }}">
                <a class="nav-link" href="/admin/home">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
            <li class="nav-item {{ Request::is('admin/user*') ? 'active' : '' }}">
                <a class="nav-link" href="/admin/user">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span></a>
            </li>
            <li class="nav-item {{ Request::is('admin/product*') ? 'active' : '' }}">
                <a class="nav-link" href="/admin/product">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Product</span></a>
            </li>
            <li class="nav-item {{ Request::is('admin/coupon*') ? 'active' : '' }}">
                <a class="nav-link" href="/admin/coupon">
                    <i class="fas fa-fw fa-ticket-alt"></i>
                    <span>Coupon</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
        
        </ul>
        <!-- End of Sidebar -->