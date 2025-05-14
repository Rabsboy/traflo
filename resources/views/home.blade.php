@extends('layouts.app')

@section('content')
<main>
      <!--=============== HOME ===============-->
      <section
        class="hero"
        id="hero"
        style="background-repeat: no-repeat; background-size: cover; height: 100vh; background-image: url('{{ asset('storage/images/20220331111950-1-labuan-bajo-011-gilar-ramdhani.jpg') }}');"
      >
        <div class="hero-content h-100 d-flex justify-content-center align-items-center flex-column">
          <h1 class="text-center text-white display-4">
            Temukan Keindahan Flores dengan Mudah Bersama Kami
          </h1>
          <a href="#package" class="btn btn-primary mt-5">Pesan Sekarang</a>
        </div>
      </section>

<!--=============== Why Us ===============-->
<section class="container why-us text-center mb-5">
    <h2 class="section-title">Kenapa Memilih Kami?</h2>
    <hr width="40" class="mx-auto" />
    <div class="row mt-5">
        <!-- All-In-One Package -->
        <div class="col-lg-4 mb-3">
            <div class="card pt-4 pb-3 px-2">
                <div class="why-us-content">
                    <i class="bx bx-package why-us-icon mb-4"></i>
                    <h4 class="mb-3">Paket All-In-One</h4>
                    <p>
                        Nikmati perjalanan bebas ribet dengan paket lengkap yang mencakup akomodasi, makan, dan transportasi.
                    </p>
                </div>
            </div>
        </div>
        <!-- Stay Safe -->
        <div class="col-lg-4 mb-3">
            <div class="card pt-4 pb-3 px-2">
                <div class="why-us-content">
                    <i class="bx bxs-shield-alt-2 why-us-icon mb-4"></i>
                    <h4 class="mb-3">Jaga Keamanan Anda</h4>
                    <p>
                        Keamanan dan kenyamanan Anda adalah prioritas utama kami, dijamin dengan standar operasional yang terpercaya.
                    </p>
                </div>
            </div>
        </div>
        <!-- Save Time -->
        <div class="col-lg-4 mb-3">
            <div class="card pt-4 pb-3 px-2">
                <div class="why-us-content">
                    <i class="bx bx-time-five why-us-icon mb-4"></i>
                    <h4 class="mb-3">Hemat Waktu</h4>
                    <p>
                        Biarkan kami mengurus segala hal terkait perjalanan Anda, sehingga Anda bisa fokus menikmati momen liburan Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--=============== Package ===============-->
@foreach($categories as $category)
<section class="container package text-center" id="package">
    <h2 class="section-title">{{ $category->title }}</h2>
    <hr width="40" class="mx-auto" />
    <div class="row mt-5 justify-content-center">
    @foreach($category->travel_packages as $travelPackage)
    <div class="col-lg-3" style="margin-bottom: 140px">
        <div class="card package-card">
            <a href="{{ route('detail', $travelPackage) }}" class="package-link">
                <div class="package-wrapper-img overflow-hidden">
                    <img src="{{ Storage::url($travelPackage->galleries->first()->path) }}" class="img-fluid" />
                </div>
                <div class="package-price d-flex justify-content-center">
                    <span class="btn btn-light position-absolute package-btn">
                        Mulai dari IDR {{ number_format($travelPackage->price) }} per orang
                    </span>
                </div>

                <h5 class="btn position-absolute w-100">
                    Ayo Ikut Travel {{ $travelPackage->name }} Sekarang!
                </h5>
            </a>
        </div>
    </div>
    @endforeach
    </div>
</section>
@endforeach

<!--=============== Cars ===============-->
<section class="container text-center">
    <h2 class="section-title">Daftar Harga Transportasi</h2>
    <hr width="40" class="mx-auto" />
    <div class="row">
    @foreach(\App\Models\Car::get() as $car)
    <div class="col-lg-3 mb-5">
        <div class="card p-3 border-0" style="border-radius: 0;text-align:left;">
            <img style="height: 200px;object-fit: contain;" src="{{ Storage::url($car->image) }}" alt="">
            <h4 class="main-color fw-bold mb-4" style="font-size: 1.4rem">{{ $car->name }}</h4>
            <span class="fw-bold mb-4">IDR {{ number_format($car->price) }} </span> 
            <span class="d-flex mb-3"><i class='bx bxs-gas-pump main-color fs-4 me-3'></i> <strong>Driver + BBM</strong> </span> 
            <span class="d-flex"><i class='bx bxs-time-five main-color fs-4 me-3'></i> <strong>{{ $car->duration }}</strong></span>

        </div>
    </div>
    @endforeach
    </div>
</section>

<!--=============== Video ===============-->
<section class="container text-center">
    <h2 class="section-title">Keindahan Flores</h2>
    <hr width="40" class="mx-auto" />
    <p>Ikuti tur visual seru dan temukan keindahan Flores melalui video kami!</p>
    <div class="row mt-5">
        <div class="col-12">
            <iframe width="100%" height="500px" src="https://www.youtube.com/embed/VbDlTb21aUc?si=WEnnBAvtT9WzvXsG&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
</section>

<!--=============== Blog ===============-->
<section class="container blog text-center">
    <h2 class="section-title">Cerita Perjalanan & Tips Wisata</h2>
    <hr width="40" class="mx-auto" />
    <p>Temukan inspirasi dan cerita seru dari para traveler di blog kami!</p>
    <div class="row justify-content-center mt-5">
    @foreach($posts as $post)
    <div class="col-lg-4 mb-4 blogpost">
        <a href="{{ route('posts.show', $post) }}">
            <div class="card-post">
                <div class="card-post-img">
                  <img src="{{ Storage::url($post->image) }}"alt="{{ $post->title }}">
                </div>
                <div class="card-post-data">
                    <span>Travel</span> <small>- {{ $post->created_at->diffForHumans() }}</small>
                    <h5>{{ $post->title }}</h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    </div>
</section>
</main>
@endsection
