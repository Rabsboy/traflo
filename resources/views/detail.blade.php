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
                    <li class="breadcrumb-item">
                    <a class="title-alt" href="{{ route('package') }}">Package</a>
                    </li>
                    <li class="breadcrumb-item main-color">Paket Detail</li>
                </ol>
            </nav>
        </div>

        <div class="col-12 col-md text-center animate__animated animate__fadeIn">
            <h1 class="main-color">{{ $travelPackage->name }}</h1>
            <span class="title-alt">{{ $travelPackage->location }}</span>
        </div>
    </section>

    <section class="container detail animate__animated animate__fadeIn animate__delay-1s">
        <div class="swiper mySwiper detail-container">
            <div class="swiper-wrapper ">
                @foreach($travelPackage->galleries as $gallery)
                    <div class="detail-card swiper-slide">
                        <img src="{{ Storage::url($gallery->path) }}" alt="" class="detail-img" />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row" style="margin-top: 120px">
            <div class="col-12 col-md-12 col-lg-7 mb-5">
                <div class="card border-0 p-2 animate__animated animate__fadeIn animate__delay-2s">
                    <h3 class="fw-bolder title mb-3">Tentang Paket Wisata {{ $travelPackage->name }}</h3>
                    {!! $travelPackage->description !!}
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-5">
                <div class="card bordered card-form animate__animated animate__fadeInRight animate__delay-3s" style="padding: 30px 40px">
                    <h4 class="text-center">Mulai Booking</h4>
                    <div class="alert alert-secondary" role="alert">
                        Duration: {{ $travelPackage->duration }}
                    </div>
                    <div class="alert alert-secondary" role="alert">
                        Harga: <span class="text-gray-500 font-weight-light">IDR.{{ number_format($travelPackage->price) }}</span>
                    </div>

                    @if(Auth::check())
    @if(Auth::user()->is_admin)
        <div class="alert alert-info text-center" role="alert">
            Anda adalah <strong>administrator</strong>. Anda tidak dapat melakukan booking.
        </div>
        <button type="button" class="btn btn-secondary btn-block" disabled>Booking Tidak Tersedia</button>
    @else
        <p>Halo, {{ Auth::user()->name }}! Silakan lengkapi nomor telepon Anda untuk booking.</p>
        <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
            @csrf
            <input type="hidden" name="travel_package_id" value="{{ $travelPackage->id }}">
            <div class="form-group mt-4">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" required placeholder="Masukkan nomor telepon">
            </div>
            <div class="form-group mt-4">
                <label for="payment-amount">Amount</label>
                <input type="text" class="form-control" id="payment-amount" name="amount" value="{{ $travelPackage->price }}" readonly>
            </div>
            <div class="form-group mt-4">
                <button type="button" id="pay-button" class="btn btn-primary btn-block">Confirm Payment</button>
            </div>
        </form>
    @endif
@else
    <div class="alert alert-warning" role="alert">
        Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk melakukan booking.
    </div>
    <button type="button" class="btn btn-secondary btn-block" disabled>Confirm Payment</button>
    <div class="mt-3">
                        <a onclick="return confirm('Ingin bertanya dengan customer service kami tentang {{ $travelPackage->name }} ?')" class="btn btn-book btn-block" href="https://api.whatsapp.com/send?phone=628813562006&text=Saya mau tanya tentang paket travel {{ $travelPackage->name }}">
                            Tanya Kami Tentang {{ $travelPackage->name }}?
                        </a>
                    </div>
@endif

                    
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('style-alt')
<link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swipper/css/style.css') }}">
<style>
    .swiper-slide {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .swiper-slide:hover {
        transform: scale(1.05);
    }

    .detail-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 20px;
    }

    .card-form {
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        background: #fff;
        transition: 0.3s ease;
    }

    .card-form:hover {
        transform: translateY(-5px);
    }

    .btn-block {
        padding: 12px 20px;
        border-radius: 10px;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .btn-book {
        background-color: #28a745;
        color: white;
    }

    .btn-book:hover {
        background-color: #218838;
        transform: scale(1.03);
    }

    .breadcrumb {
        background: transparent;
    }

    h1.main-color {
        font-weight: bold;
        font-size: 3rem;
    }

    .title-alt {
        font-size: 1.2rem;
        color: #6c757d;
    }
</style>
@endpush

@push('script-alt')
<script src="{{ asset('frontend/assets/libraries/swipper/js/app.js') }}"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script src="https://unpkg.com/scrollreveal"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        loop: true,
        spaceBetween: 32,
        coverflowEffect: {
            rotate: 30,
            stretch: 0,
            depth: 150,
            modifier: 1,
            slideShadows: true,
        },
    });

    ScrollReveal().reveal('.card', {
        distance: '50px',
        duration: 1000,
        easing: 'ease-in-out',
        origin: 'bottom',
        interval: 200
    });

    @if(Auth::check())
    document.getElementById('pay-button').onclick = function(e) {
        e.preventDefault();

        var phone = document.getElementById('phone').value.trim();
        if (!phone) {
            alert('Nomor telepon wajib diisi.');
            return;
        }

        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var amount = document.getElementById('payment-amount').value;
        var travelPackageId = "{{ $travelPackage->id }}";

        fetch("{{ route('payment.process') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                name: name,
                email: email,
                phone: phone,
                amount: amount,
                travel_package_id: travelPackageId
            })
        })
        .then(response => response.json())
.then(data => {
    if (data.snapToken) {
        snap.pay(data.snapToken, {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");

                fetch('/payment/update-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        order_id: result.order_id,
                        transaction_status: result.transaction_status
                    })
                }).then(() => {
                    window.location.href = "{{ route('booking.check') }}";
                });
            },
            onPending: function(result) {
                alert("Pembayaran masih pending.");

                fetch('/payment/update-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        order_id: result.order_id,
                        transaction_status: result.transaction_status
                    })
                }).then(() => {
                    window.location.href = "{{ route('booking.check') }}";
                });
            },
            onError: function(result) {
                alert("Pembayaran gagal: " + result.status_message);

                fetch('/payment/update-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        order_id: result.order_id,
                        transaction_status: result.transaction_status
                    })
                });
            },
            onClose: function() {
                alert("Anda menutup popup tanpa menyelesaikan pembayaran.");
            }
        });
    } else {
        alert("Gagal mendapatkan token pembayaran: " + (data.error ?? 'Unknown error'));
    }
})
        .catch(error => {
            alert("Terjadi kesalahan. Silakan coba lagi.");
            console.error(error);
        });
    };
    @endif
</script>
@endpush
