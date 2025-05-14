<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.travel-packages.index') }}">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Paket Travel</span></a>
    </li>

        <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.bookings') }}">
            <i class="fas fa-list-alt"></i>
            <span>Daftar Pemesanan</span></a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.cars.index') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Transportasi</span></a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.posts.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Blog</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


</ul>