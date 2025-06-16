<header class="header" id="header">
  <nav class="nav container" role="navigation" aria-label="Primary Navigation">
    <a href="{{ route('home') }}" class="nav__logo " aria-label="Logo">
      <img
        width="250"
        style="height: 70px; object-fit: cover; border-radius: 12px;"
        src="{{ asset('frontend/assets/images/logo.png') }}"
        alt="Logo"
      />
    </a>

    <div class="nav__menu" id="nav-menu">
      <ul class="nav__list">
        <li class="nav__item">
          <a href="{{ route('home') }}" class="nav__link {{ request()->is('/') ? 'active-link' : '' }}">
            <i class="bx bx-home-alt nav__icon"></i>
            <span class="nav__name">Home</span>
          </a>
        </li>

        <li class="nav__item">
          <a href="{{ route('posts') }}" class="nav__link {{ request()->is('posts') ? 'active-link' : '' }}">
            <i class="bx bx-book-alt nav__icon"></i>
            <span class="nav__name">Blog</span>
          </a>
        </li>

        <li class="nav__item">
          <a href="{{ route('package') }}" class="nav__link {{ request()->is('paket-travel') ? 'active-link' : '' }}">
            <i class="bx bx-briefcase-alt nav__icon"></i>
            <span class="nav__name">Paket Travel</span>
          </a>
        </li>

        <li class="nav__item">
          <a href="{{ route('about') }}" class="nav__link {{ request()->is('about-us') ? 'active-link' : '' }}">
            <i class="bx bx-info-circle nav__icon"></i>
            <span class="nav__name">Tentang Kami</span>
          </a>
        </li>

        <li class="nav__item">
          <a href="{{ route('contact') }}" class="nav__link {{ Route::is('contact') ? 'active-link' : '' }}">
            <i class="bx bx-message-square-detail nav__icon"></i>
            <span class="nav__name">Hubungi Kami</span>
          </a>
        </li>

        <li class="nav__item">
          <a href="{{ route('booking.form') }}" class="nav__link {{ request()->is('cek-booking') ? 'active-link' : '' }}">
            <i class="bx bx-search-alt nav__icon"></i>
            <span class="nav__name">Cek Booking</span>
          </a>
        </li>

        @guest
          <li class="nav__item">
            <a href="{{ route('login') }}" class="nav__link login-btn">
              <i class="bx bx-log-in nav__icon"></i>
              <span class="nav__name">Login</span>
            </a>
          </li>
        @else
          <li class="nav__item dropdown" style="position: relative;">
            <a href="#" class="nav__link user-toggle" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-user nav__icon"></i>
              <span class="nav__name">{{ Auth::user()->name }}</span>
              <i class="bx bx-chevron-down dropdown-icon"></i>
            </a>
            <ul id="userDropdown" class="dropdown-menu" role="menu" aria-label="User menu">
  @if(Auth::user()->is_admin)
    <li role="none">
      <a href="{{ route('admin.dashboard') }}" class="dropdown-logout-btn" role="menuitem" tabindex="0">
        🛠️ Dashboard 
      </a>
    </li>
  @endif
  <li role="none">
    <form action="{{ route('logout') }}" method="POST" role="none">
      @csrf
      <button type="submit" class="dropdown-logout-btn" role="menuitem" tabindex="0">
        🚪 Logout
      </button>
    </form>
  </li>
</ul>

          </li>
        @endguest
      </ul>
    </div>
  </nav>
</header>

<style>
  /* Navbar container with gradient background */
.header {
  background: linear-gradient(90deg, #2c7a7b, #28527a);
  padding: 0.75rem 0;
  box-shadow: 0 8px 20px rgba(40, 82, 122, 0.3);
}

.nav.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 1.5rem;
  border-radius: 15px; 
  background: transparent;
  box-shadow: none; 
}


  /* Logo with subtle shadow and hover scale */
  .nav__logo img {
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    transition: transform 0.3s ease;
  }
  .nav__logo img:hover {
    transform: scale(1.05);
  }

  /* Nav list flex layout */
  .nav__list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 1.6rem;
    align-items: center;
  }

  /* Nav item positioning */
  .nav__item {
    position: relative;
  }

  /* Nav links styling */
  .nav__link {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-weight: 700;
    font-size: 1.1rem;
    color: #eef2f3;
    text-decoration: none;
    padding: 0.6rem 1.2rem;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.15);
    cursor: pointer;
    transition:
      background-color 0.3s ease,
      color 0.3s ease,
      box-shadow 0.3s ease,
      transform 0.25s ease;
  }
  .nav__link:hover,
  .nav__link.active-link {
    background: #61bc48;
    color: #fff;
    box-shadow:
      0 0 10px #61bc48,
      inset 0 0 8px #4a9f36;
    transform: translateY(-2px);
  }

  /* Nav icons */
  .nav__icon {
    font-size: 1.5rem;
    transition: transform 0.25s ease, color 0.25s ease;
    color: #d0e6db;
  }
  .nav__link:hover .nav__icon,
  .nav__link.active-link .nav__icon {
    transform: scale(1.2) rotate(10deg);
    color: #fff;
  }

  /* Login button */
  .login-btn {
    background: #61bc48;
    box-shadow: 0 4px 14px #50a63bcc;
    color: #fff !important;
    font-weight: 800;
    border-radius: 18px;
    padding: 0.5rem 1.4rem;
    transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
  }
  .login-btn:hover {
    background: #4a9f36;
    box-shadow: inset 0 0 12px #3f7d28;
    transform: translateY(-2px);
  }

  /* Dropdown */
  .nav__item.dropdown {
    cursor: pointer;
  }
  .dropdown-icon {
    font-size: 0.9rem;
    margin-left: 6px;
    transition: transform 0.35s ease, color 0.35s ease;
    color: #d0e6db;
  }
  .nav__item.dropdown.open > .nav__link .dropdown-icon {
    transform: rotate(180deg);
    color: #61bc48;
  }

  /* Dropdown menu with fade and slide */
  .dropdown-menu {
    display: block; /* Keep block for positioning */
    position: absolute;
    top: 110%;
    left: 0;
    background: #ffffffee;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    border-radius: 14px;
    padding: 0.6rem 0;
    min-width: 160px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: opacity 0.35s ease, transform 0.35s ease, visibility 0.35s ease;
    pointer-events: none;
    user-select: none;
    z-index: 1000;
  }
  .nav__item.dropdown.open .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
  }
  .dropdown-menu li {
    padding: 0;
  }
  .dropdown-logout-btn {
    width: 100%;
    text-align: left;
    padding: 0.65rem 1.2rem;
    background: none;
    border: none;
    font-size: 1.05rem;
    color: #444;
    cursor: pointer;
    border-radius: 12px;
    transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
    user-select: none;
  }
  .dropdown-logout-btn:hover {
    background-color: #721007;
    color: white;
    box-shadow: 0 0 12px rgba(114, 16, 7, 0.75);
    transform: translateX(4px);
  }

  /* Accessibility focus */
  .nav__link:focus,
  .dropdown-logout-btn:focus {
    outline: 3px solid #61bc48;
    outline-offset: 3px;
  }

  /* Container max width */
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
  }

  /* Responsive: nav list stack on small screen */
  @media (max-width: 768px) {
    .nav__list {
      flex-direction: column;
      gap: 0.8rem;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const dropdownToggle = document.querySelector('.nav__item.dropdown .user-toggle');
    const dropdownItem = document.querySelector('.nav__item.dropdown');

    dropdownToggle?.addEventListener('click', (e) => {
      e.preventDefault();
      const isOpen = dropdownItem.classList.toggle('open');
      dropdownToggle.setAttribute('aria-expanded', isOpen);
    });

    document.addEventListener('click', (e) => {
      if (!dropdownItem.contains(e.target)) {
        dropdownItem.classList.remove('open');
        dropdownToggle.setAttribute('aria-expanded', false);
      }
    });

    // Accessibility: close dropdown on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        if (dropdownItem.classList.contains('open')) {
          dropdownItem.classList.remove('open');
          dropdownToggle.setAttribute('aria-expanded', false);
          dropdownToggle.focus();
        }
      }
    });
  });
</script>
