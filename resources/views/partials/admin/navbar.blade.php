<nav class="navbar navbar-expand navbar-light bg-white shadow-sm fixed-top px-4">
    <!-- Sidebar Toggle (Responsive) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Right Side Navbar -->
    <ul class="navbar-nav ms-auto d-flex align-items-center">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                <span class="me-2 text-dark small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" width="32" height="32" alt="User Avatar">
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a></li>
            </ul>
        </li>
    </ul>
</nav>
