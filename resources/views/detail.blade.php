@extends('layouts.app')

@section('content')
<main>
    <section class="container mt-5" style="margin-bottom: 70px">
        <div class="col-12 col-md">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="title-alt" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item main-color">Paket Detail</li>
                </ol>
            </nav>
        </div>

        <div class="col-12 col-md text-center">
            <h1 class="main-color">{{ $travelPackage->name }}</h1>
            <span class="title-alt">{{ $travelPackage->location }}</span>
        </div>
    </section>

    <!--=============== Package Travel ===============-->
    <section class="container detail">
        <div class="swiper mySwiper detail-container">
            <div class="swiper-wrapper">
                @foreach($travelPackage->galleries as $gallery)
                    <div class="detail-card swiper-slide">
                        <img
                            src="{{ Storage::url($gallery->path) }}"
                            alt=""
                            class="detail-img"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row" style="margin-top: 120px">
            <div class="col-12 col-md-12 col-lg-7 mb-5">
                <div class="card border-0 p-2">
                    <h3 class="fw-bolder title mb-4">Tentang Paket Wisata</h3>
                    {!! $travelPackage->description !!}
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card bordered card-form" style="padding: 30px 40px">
                    <h4 class="text-center">Start Booking</h4>
                    <div class="alert alert-secondary"
                        style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                        Duration: {{ $travelPackage->duration }}
                    </div>
                    <div class="alert alert-secondary"
                        style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                        Harga :
                        <span class="text-gray-500 font-weight-light">IDR.{{ number_format($travelPackage->price) }}</span>
                    </div>


                    <!-- Personal Data Form -->
                    <form action="{{ route('booking.store', $travelPackage->id) }}" method="POST">
                        @csrf

                        <div class="form-group mt-4">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group mt-4">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group mt-4">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>

                        <!-- Payment Method Dropdown -->
                        <div class="form-group mt-4">
                            <label for="payment-method">Select Payment Method</label>
                            <select id="payment-method" name="payment_method" class="form-control">
                                <option value="credit-card">Credit Card</option>
                                <option value="bank-transfer">Bank Transfer</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <!-- Display payment amount -->
                        <div class="form-group mt-4">
                            <label for="payment-amount">Amount</label>
                            <input type="text" class="form-control" id="payment-amount" value="IDR.{{ number_format($travelPackage->price) }}" readonly>
                        </div>

                        <!-- Confirm Payment Button -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Confirm Payment</button>
                        </div>
                    </form>

                    <!-- Continue to WhatsApp -->
                    <div class="mt-3">
                        <a onClick="return confirm('Ingin bertanya dengan customer service kami tentang {{ $travelPackage->name }} ?')" class="btn btn-book btn-block" href="https://api.whatsapp.com/send?phone=628813562006&text= Saya mau tanya tentang paket travel {{ $travelPackage->name }}">
                            Tanya Kami Tentang {{ $travelPackage->name }}?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('style-alt')
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swipper/css/style.css') }}">
    <style>
        .swiper-container-3d .swiper-slide-shadow-left,
        .swiper-container-3d .swiper-slide-shadow-right {
            background-image: none;
        }

        /* Additional Styles for Payment Form */
        .payment-method {
            margin-top: 20px;
        }
    </style>
@endpush

@push('script-alt')
    <script src="{{ asset('frontend/assets/libraries/swipper/js/app.js') }}"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            spaceBetween: 32,
            coverflowEffect: {
                rotate: 0,
            },
        });
    </script>
@endpush
