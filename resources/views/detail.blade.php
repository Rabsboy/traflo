@extends('layouts.app')

@section('content')
<main>
    <section class="container mt-5" style="margin-bottom: 70px">
        <div class="col-12 col-md">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="title-alt" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="title-alt" href="{{ route('package') }}">Package</a></li>
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
            <div class="swiper-wrapper">
                @foreach($travelPackage->galleries as $gallery)
                    <div class="detail-card swiper-slide">
                        <img src="{{ Storage::url($gallery->path) }}" alt="" class="detail-img" />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row" style="margin-top: 120px">
            <div class="col-12 col-lg-7 mb-5">
                <div class="card border-0 p-2 animate__animated animate__fadeIn animate__delay-2s">
                    <h3 class="fw-bolder title mb-3">Tentang Paket Wisata {{ $travelPackage->name }}</h3>
                    {!! $travelPackage->description !!}
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="card card-form animate__animated animate__fadeInRight animate__delay-3s p-4">
                    <h4 class="text-center">Mulai Booking</h4>
                    <div class="alert alert-secondary">Duration: {{ $travelPackage->duration }}</div>
                    <div class="alert alert-secondary">
                        Harga: <span class="text-gray-500 font-weight-light">IDR.{{ number_format($travelPackage->price) }}</span>
                    </div>

                    @auth
                        @if(Auth::user()->is_admin)
                            <div class="alert alert-info text-center">Anda adalah <strong>administrator</strong>. Booking tidak tersedia.</div>
                            <button type="button" class="btn btn-secondary btn-block" disabled>Booking Tidak Tersedia</button>
                        @else
                            <p>Halo, {{ Auth::user()->name }}! Silakan lengkapi data di bawah ini.</p>
                            <form id="payment-form">
                                @csrf
                                <input type="hidden" id="travel_package_id" value="{{ $travelPackage->id }}">

                                <div class="form-group mt-4">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" readonly>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="phone">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Masukkan nomor telepon" required>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="payment-amount">Total Bayar</label>
                                    <input type="text" class="form-control" id="payment-amount" value="{{ $travelPackage->price }}" readonly>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="departure_date">Tanggal Keberangkatan</label>
                                    <select id="departure_date" name="departure_date" class="form-control" required>
                                        @foreach ($travelPackage->departures as $date)
                                            <option value="{{ $date->departure_date }}">
                                                {{ \Carbon\Carbon::parse($date->departure_date)->format('d M Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="button" id="pay-button" class="btn btn-primary btn-block">Bayar Sekarang</button>
                                </div>
                            </form>
                        @endif
                    @else
                        <div class="alert alert-warning">Silakan <a href="{{ route('login') }}">login</a> untuk melakukan booking.</div>
                        <button type="button" class="btn btn-secondary btn-block" disabled>Booking Tidak Tersedia</button>
                        <div class="mt-3">
                            <a onclick="return confirm('Ingin bertanya tentang {{ $travelPackage->name }} ?')" class="btn btn-book btn-block"
                               href="https://api.whatsapp.com/send?phone=628813562006&text=Saya mau tanya tentang paket travel {{ $travelPackage->name }}">
                               Tanya Kami Tentang {{ $travelPackage->name }}
                            </a>
                        </div>
                    @endauth
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
    document.addEventListener("DOMContentLoaded", function () {
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

        @auth
        @if(!Auth::user()->is_admin)
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function (e) {
            e.preventDefault();

            const phone = document.getElementById('phone').value.trim();
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const amount = document.getElementById('payment-amount').value.trim();
            const departureDate = document.getElementById('departure_date').value.trim();
            const travelPackageId = document.getElementById('travel_package_id').value;

            if (!phone) {
                alert('Nomor telepon wajib diisi.');
                return;
            }

            fetch("{{ route('payment.process') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name, email, phone, amount,
                    travel_package_id: travelPackageId,
                    departure_date: departureDate
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    snap.pay(data.snapToken, {
                        onSuccess: handleResult,
                        onPending: handleResult,
                        onError: handleResult,
                        onClose: function() {
                            alert("Anda menutup popup tanpa menyelesaikan pembayaran.");
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token pembayaran.");
                }
            })
            .catch(error => {
                alert("Terjadi kesalahan. Silakan coba lagi.");
                console.error(error);
            });

            function handleResult(result) {
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
            }
        });
        @endif
        @endauth
    });
</script>
@endpush
