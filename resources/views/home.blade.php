@extends('layouts.app')

@section('content')
<main>
  <!--=============== HOME ===============-->
  <section
  class="hero position-relative"
  id="hero"
  style="background-image: url('{{ asset('storage/images/bg.jpg') }}'); background-size: cover; background-position: center; height: 100vh;"
>
  <!-- Overlay -->
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

  <!-- Hero Content -->
  <div class="hero-content position-relative z-2 h-100 d-flex flex-column justify-content-center align-items-center text-white text-center px-3">
    <h1 class="display-4 fw-bold animate__animated animate__fadeInDown mb-4" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.7);">
      Temukan Keindahan Flores dengan Mudah Bersama Kami
    </h1>
    <p class="lead animate__animated animate__fadeInUp animate__delay-1s mb-4" style="max-width: 700px;">
      Jelajahi destinasi eksotis, budaya yang kaya, dan petualangan tak terlupakan. Traflo siap menjadi mitra perjalanan terbaik Anda.
    </p>
    <a href="#package" class="btn btn-lg btn-primary shadow-lg animate__animated animate__fadeInUp animate__delay-2s">
      Pesan Sekarang
    </a>
  </div>
</section>

  <!--=============== Why Us ===============-->
  <section class="container why-us text-center mb-5">
    <h2 class="mt-5 mb-2 fw-bold">Kenapa Memilih Kami?</h2>
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
  <section class="container package text-center mb-5" id="package">
    <h2 class="mt-5 mb-2 fw-bold">{{ $category->title }}</h2>
    <hr width="40" class="mx-auto" />
    <p class="mb-4 text-muted">Telusuri Paket Kami</p>

    <div class="row justify-content-center">
      @foreach($category->travel_packages as $travelPackage)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-5">
          <div class="card shadow-sm border-0 h-100 hover-shadow transition rounded-4 overflow-hidden">
            <a href="{{ route('detail', $travelPackage) }}" class="text-decoration-none text-dark">
              <div class="position-relative">
                @if($travelPackage->galleries->isNotEmpty())
                  <img 
                    src="{{ Storage::url($travelPackage->galleries->first()->path) }}" 
                    class="img-fluid w-100" 
                    style="height: 220px; object-fit: cover;"
                  />
                @else
                  <img 
                    src="{{ asset('images/default.jpg') }}" 
                    class="img-fluid w-100" 
                    style="height: 220px; object-fit: cover;"
                  />
                @endif
                <span 
                  class="badge bg-success position-absolute top-0 start-0 m-2 px-3 py-2"
                  style="font-size: 0.85rem;"
                >
                  IDR {{ number_format($travelPackage->price) }}
                </span>
              </div>
              <div class="card-body text-start px-3 py-4">
                <h5 class="fw-semibold mb-2">
                  {{ $travelPackage->name }}
                </h5>
                <p class="text-muted mb-3" style="font-size: 0.9rem;">
                  Ayo ikut perjalanan seru ke {{ $travelPackage->name }} sekarang!
                </p>
                <button class="btn btn-success w-100">
                  Ikut Sekarang
                </button>
              </div>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endforeach


  <!--=============== Video ===============-->
  <section class="container text-center">
    <h2 class="mt-5 mb-2 fw-bold">Keindahan Flores</h2>
    <hr width="40" class="mx-auto" />
    <p>Ikuti tur visual seru dan temukan keindahan Flores melalui video kami!</p>
    <div class="row mt-5">
      <div class="col-12">
        <iframe width="100%" height="500px" src="https://www.youtube.com/embed/VbDlTb21aUc?si=WEnnBAvtT9WzvXsG&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </div>
  </section>
  <!--=============== Blog ===============-->

  <section class="container text-center">
    <h2 class="mt-5 mb-2 fw-bold">Cerita Perjalanan & Tips Wisata</h2>
    <hr width="40" class="mx-auto" />
  <p class="text-center">Temukan inspirasi dan cerita seru dari para traveler di blog kami!</p>

  <div class="row justify-content-center g-4 mt-4">
    @foreach($posts as $post)
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
        <div class="card shadow-sm h-100 blog-card">
          <img 
            src="{{ Storage::url($post->image) }}" 
            alt="{{ $post->title }}" 
            class="card-img-top object-fit-cover" 
            style="height: 180px; object-fit: cover;"
          >
          <div class="card-body text-start">
            <small class="text-muted d-block mb-1">Travel - {{ $post->created_at->diffForHumans() }}</small>
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text text-muted mb-0">
              {{ Str::limit(strip_tags($post->content), 100, '...') }}
            </p>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</section>


  <!--=============== Tim Kami ===============-->
  <section class="container my-5 text-center" id="our-team">
    <h2 class="mb-4">Tim Kami</h2>
    <hr class="mx-auto mb-4" style="width: 60px; border-top: 3px solid #28a745;" />
    <div class="row justify-content-center g-4">
      @foreach($teams as $team)
      <div class="col-md-4 col-sm-6">
        <div class="card h-100 shadow team-card border-0 rounded overflow-hidden text-center position-relative">
          @if($team->photo)
          <div class="team-photo-wrapper overflow-hidden rounded-top">
            <img src="{{ asset('storage/' . $team->photo) }}" alt="{{ $team->name }}" class="team-photo w-100" />
          </div>
          @endif
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-2 team-name">{{ $team->name }}</h5>
            <p class="card-text text-muted team-desc">{{ $team->description }}</p>
          </div>
          @if(isset($team->socials) && count($team->socials))
          <div class="social-icons mb-3">
            @foreach($team->socials as $icon => $link)
            <a href="{{ $link }}" target="_blank" class="text-primary mx-2 social-link" aria-label="{{ $icon }}">
              <i class="bx bxl-{{ $icon }} fs-4"></i>
            </a>
            @endforeach
          </div>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </section>
</main>
@endsection

@push('style-alt')
<style>
  /* Team Section Styling */
  #our-team {
    background-color: #f7f9fc;
    padding: 60px 0;
  }
  .team-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 12px rgb(0 0 0 / 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 30px rgb(0 0 0 / 0.15);
  }
  .team-photo-wrapper {
    height: 250px;
    overflow: hidden;
    border-radius: 15px 15px 0 0;
    position: relative;
  }
  .team-photo-wrapper {
  height: 500px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f8f9fa;
}

.team-photo {
  height: 100%;
  width: auto;
  object-fit: cover;
}
  .team-name {
    font-size: 1.4rem;
    transition: color 0.3s ease;
  }
  .team-card:hover .team-name {
    color: #1abc9c;
  }
  .team-desc {
    font-size: 1rem;
    color: #6c757d;
    transition: color 0.3s ease;
  }
  .team-card:hover .team-desc {
    color: #2c3e50;
  }
  .social-icons {
    margin-top: auto;
    padding-bottom: 15px;
  }
  .social-link {
    color: #1abc9c;
    transition: color 0.3s ease;
  }
  .social-link:hover {
    color: #16a085;
    text-decoration: none;
  }
  /* Responsive */
  @media (max-width: 768px) {
    .team-photo-wrapper {
      height: 200px;
    }
  }
  @media (max-width: 576px) {
    .team-card {
      margin-bottom: 2rem;
    }
  }
</style>
@endpush
