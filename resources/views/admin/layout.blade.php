<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel Admin') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    @include('partials.admin.style')

    <style>
        /* Custom scrollbar for sidebar */
        #sidebar-wrapper {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #6c757d #e9ecef;
        }
        #sidebar-wrapper::-webkit-scrollbar {
            width: 8px;
        }
        #sidebar-wrapper::-webkit-scrollbar-track {
            background: #e9ecef;
        }
        #sidebar-wrapper::-webkit-scrollbar-thumb {
            background-color: #6c757d;
            border-radius: 4px;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        /* Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: none;
            width: 3rem;
            height: 3rem;
            text-align: center;
            color: white;
            background: #0d6efd;
            line-height: 46px;
            border-radius: 50%;
            z-index: 9999;
            transition: background-color 0.3s ease;
        }
        .scroll-to-top:hover {
            background-color: #0b5ed7;
            text-decoration: none;
        }
        /* Bikin sidebar tetap di kiri (fixed) */
#sidebar-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    z-index: 1030;
}

/* Konten utama offset ke kanan supaya tidak tertutup sidebar */
#content-wrapper {
    
    margin-left: 220px;
    width: calc(100% - 250px);
}

/* Navbar juga di-offset */
#content #navbar {
    margin-left: 250px;
}


/* Responsive - Sidebar jadi relatif (non-fixed) di mobile */
@media (max-width: 768px) {
    #sidebar-wrapper {
        position: relative;
        width: 100%;
        height: auto;
    }

    #content-wrapper {
        margin-left: 0;
        width: 100%;
    }
    
}

    </style>
</head>
<body id="page-top">
    <div id="wrapper" class="d-flex">

        {{-- Sidebar --}}
        @include('partials.admin.sidebar')

        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column min-vh-100">

            {{-- Main Content --}}
            <div id="content">
                {{-- Navbar --}}
                @include('partials.admin.navbar')

                {{-- Page Content --}}
                <main class="container-fluid py-4 flex-grow-1"style="margin-top: 80px;">
                    @yield('content')
                </main>
            </div>

            {{-- Footer --}}
            @include('partials.admin.footer')
        </div>
    </div>

    {{-- Scroll to Top Button --}}
    <a href="#page-top" class="scroll-to-top" id="scrollTopBtn" aria-label="Scroll to top">
        <i class="fas fa-angle-up fa-lg"></i>
    </a>

    {{-- Logout Modal --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="logoutModalLabel">Siap untuk Keluar?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Pilih "Keluar" jika Anda siap mengakhiri sesi saat ini.
                </div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-between w-100">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <!-- FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    @include('partials.admin.script')

    <script>
      $(document).ready(function () {
        $('.summernote').summernote({
          height: 200,
          placeholder: 'Tulis konten di sini...',
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'help']]
          ]
        });
      });

      // Scroll to top button behavior
      const scrollTopBtn = document.getElementById('scrollTopBtn');
      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 100) {
          scrollTopBtn.style.display = 'block';
        } else {
          scrollTopBtn.style.display = 'none';
        }
      });

      scrollTopBtn.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
      document.getElementById('sidebarToggleTop')?.addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar-wrapper');
        if (sidebar) {
            sidebar.classList.toggle('d-none');
        }
    });
    </script>

    @stack('script-alt')
</body>
</html>
