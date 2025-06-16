<ul class="navbar-nav sidebar sidebar-dark accordion"
    id="accordionSidebar"
    style="background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
           position: fixed;
           top: 0;
           left: 0;
           height: 100vh;
           width: 250px;
           z-index: 1050;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-4 mx-3 mt-3 " href="{{ route('home') }}">
        <div class="sidebar-brand-icon me-2 bg-white  rounded shadow-sm">
            <img src="{{ asset('frontend/assets/images/logo-transparent.png') }}" alt="Traflo Logo" style="width: 40px; height: 40px;">
        </div>
        <div class="sidebar-brand-text fw-bold text-white fs-6">TRAFLO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-3 border-light ">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active shadow-sm bg-white text-dark fw-bold rounded-start' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt fw-bold fa-fw me-2"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider my-1 border-light">

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->is('admin/users*') ? 'active shadow-sm bg-white text-dark fw-bold rounded-start' : '' }}" href="{{ url('admin/users') }}">
            <i class="fas fa-user fw-bold fa-fw me-2"></i>
            <span>Pelanggan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.travel-packages.*') ? 'active shadow-sm bg-white text-dark fw-bold rounded-start' : '' }}" href="{{ route('admin.travel-packages.index') }}">
            <i class="fas fa-briefcase fw-bold fa-fw me-2"></i>
            <span>Paket Travel</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.bookings') ? 'active shadow-sm bg-white text-dark fw-bold rounded-start' : '' }}" href="{{ route('admin.bookings') }}">
            <i class="fas fa-list-alt fw-bold fa-fw me-2"></i>
            <span>Daftar Pemesanan</span>
        </a>
    </li>

    {{-- Uncomment jika dibutuhkan
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.cars.*') ? 'active shadow-sm bg-white text-dark rounded-start' : '' }}" href="{{ route('admin.cars.index') }}">
            <i class="fas fa-car fa-fw me-2"></i>
            <span>Transportasi</span>
        </a>
    </li>
    --}}

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.posts.*') ? 'active shadow-sm bg-white text-dark fw-bold rounded-start' : '' }}" href="{{ route('admin.posts.index') }}">
            <i class="fas fa-book fw-bold fa-fw me-2"></i>
            <span>Blog</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.team.*') ? 'active shadow-sm bg-white text-dark fw-bold rounded-start' : '' }}" href="{{ route('admin.team.index') }}">
            <i class="fas fa-users fw-bold fa-fw me-2"></i>
            <span>Our Team</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.footer.edit') ? 'active shadow-sm bg-white text-dark fw-bold rounded-start' : '' }}" href="{{ route('admin.footer.edit') }}">
            <i class="fas fa-cogs fw-bold fa-fw me-2"></i>
            <span>Pengaturan Page</span>
        </a>
    </li>

    <hr class="sidebar-divider my-3 border-light">
</ul>
