<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts: Poppins & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Boxicons Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
      
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/bootstrap/css/bootstrap.min.css') }}" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />

    @stack('style-alt')

    <style>
        /* Reset some basic elements */
        body, h1, h2, h3, h4, h5, h6, p, ul {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: #2c3e50;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

        /* Smooth scroll for anchor links */
        html {
            scroll-behavior: smooth;
        }

        /* Header & Footer base style (assuming partials) */
        header, footer {
            background: #2c3e50;
            color: #fff;
            padding: 1rem 0;
        }

        header a, footer a {
            color: #fff;
        }

        header a:hover, footer a:hover {
            color: #1abc9c;
        }

        /* Container tweaks */
        main {
            flex-grow: 1;
            padding: 2rem 1rem;

            margin: 0 auto;
            width: 100%;
        }

        /* Utility classes */
        .text-center {
            text-align: center;
        }

        /* Buttons */
        .btn-primary {
            background-color: #1abc9c;
            border-color: #1abc9c;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #16a085;
            border-color: #16a085;
        }

        /* Boxicons in navbar or anywhere */
        .bx {
            font-size: 1.2rem;
            vertical-align: middle;
            transition: color 0.3s ease;
        }

        .bx:hover {
            color: #1abc9c;
        }

        /* Responsive improvements */
        @media (max-width: 576px) {
            main {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/assets/libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}">
    </script>

    @stack('script-alt')
</body>
</html>
