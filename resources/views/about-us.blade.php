@extends('layouts.app')

@section('content')
<main>

  {{-- Section 1: Hero About Traflo --}}
  <section class="container mt-5 mb-5">
    <div class="text-center mb-5">
      <h1 class="display-4 fw-bold  main-color animate__animated animate__fadeInDown">Tentang Traflo</h1>
      <p class="animate__animated animate__fadeInUp title-alt fst-italic animate-fade-in delay-1">Easy Travel to Flores</p>
    </div>

    <div class="row align-items-center mb-5">
      <div class="animate__animated animate__fadeInUp col-md-6 mb-4 mb-md-0 animate-slide-left">
        <img src="{{ asset('frontend/assets/images/logo.png') }}" 
          class="img-fluid rounded shadow-lg" alt="Tentang Traflo">
      </div>
      <div class="animate__animated animate__fadeInRight col-md-6 animate-slide-right">
        <h4 class="fw-bold mb-3">Siapa Kami?</h4>
        <p class="text-muted fs-5 lh-lg">
          <strong>Traflo (Travel Flores)</strong> adalah platform layanan perjalanan yang berdedikasi memperkenalkan pesona alam dan kekayaan budaya Pulau Flores, Nusa Tenggara Timur, ke dunia.
          Kami percaya bahwa setiap perjalanan harus menjadi pengalaman yang berkesan dan penuh makna.
        </p>
        <p class="text-muted fs-5 lh-lg">
          Sejak berdiri, Traflo telah membantu ribuan traveler menjelajahi destinasi tersembunyi, menikmati keindahan alam yang autentik, serta berinteraksi dengan komunitas lokal secara langsung dan bertanggung jawab.
        </p>
      </div>
    </div>
  </section>

  {{-- Section 2: Misi Kami --}}
  <section class="container mb-5 py-5 bg-light rounded shadow-sm">
    <h4 class="fw-bold text-center mb-4 animate-fade-in">Misi Kami</h4>
    <div class="row text-center">
      <div class="col-md-4 mb-4 animate-zoom-in delay-1">
        <div class="card p-4 h-100 shadow-sm rounded-4 border-0">
          <i class="fas fa-shield-alt fa-3x main-color mb-3"></i>
          <p class="fs-6 fw-semibold">
            Memberikan pengalaman perjalanan yang <br> aman dan nyaman bagi setiap pelanggan.
          </p>
        </div>
      </div>
      <div class="col-md-4 mb-4 animate-zoom-in delay-2">
        <div class="card p-4 h-100 shadow-sm rounded-4 border-0">
          <i class="fas fa-globe-asia fa-3x main-color mb-3"></i>
          <p class="fs-6 fw-semibold">
            Memperkenalkan keindahan wisata dan budaya unik <br> Flores kepada wisatawan lokal maupun mancanegara.
          </p>
        </div>
      </div>
      <div class="col-md-4 mb-4 animate-zoom-in delay-3">
        <div class="card p-4 h-100 shadow-sm rounded-4 border-0">
          <i class="fas fa-hand-holding-usd fa-3x main-color mb-3"></i>
          <p class="fs-6 fw-semibold">
            Mendukung dan memberdayakan pertumbuhan ekonomi <br> masyarakat lokal Flores melalui pariwisata berkelanjutan.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- Section 3: Layanan Kami --}}
  <section class="container mb-5">
    <h4 class="fw-bold text-center mb-4 animate-fade-in">Layanan Kami</h4>
    <ul class="list-group list-group-flush fs-5 lh-lg animate-slide-up px-md-5 px-3">
      <li class="list-group-item border-0 px-0 mb-2">✔️ Paket perjalanan lengkap yang mencakup akomodasi, transportasi, dan pemandu lokal berpengalaman.</li>
      <li class="list-group-item border-0 px-0 mb-2">✔️ Custom trip sesuai kebutuhan dan preferensi Anda untuk pengalaman yang lebih personal.</li>
      <li class="list-group-item border-0 px-0 mb-2">✔️ Tim pelayanan pelanggan yang ramah, profesional, dan siap membantu kapan saja.</li>
      <li class="list-group-item border-0 px-0 mb-2">✔️ Proses pemesanan mudah dan cepat melalui website dengan fitur lengkap dan responsif.</li>
      <li class="list-group-item border-0 px-0 mb-2">✔️ Informasi lengkap mengenai destinasi wisata serta tips perjalanan untuk membantu persiapan Anda.</li>
    </ul>
  </section>

  {{-- Section 4: Kenapa Memilih Kami? --}}
  <section class="container why-us text-center mb-5 py-4 bg-white rounded shadow-sm">
    <h2 class="fw-bold text-center mb-4 animate-fade-in">Kenapa Memilih Kami?</h2>
    <div class="row mt-3">
      <div class="col-lg-4 mb-3 animate-zoom-in delay-1">
        <div class="card pt-4 pb-3 px-2 h-100 shadow-sm rounded-4 border-0">
          <div class="why-us-content">
            <i class="bx bx-package why-us-icon mb-4"></i>
            <h4 class="mb-3">Paket All-In-One</h4>
            <p>
              Nikmati perjalanan bebas ribet dengan paket lengkap yang mencakup akomodasi, makan, dan transportasi.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-3 animate-zoom-in delay-2">
        <div class="card pt-4 pb-3 px-2 h-100 shadow-sm rounded-4 border-0">
          <div class="why-us-content">
            <i class="bx bxs-shield-alt-2 why-us-icon mb-4"></i>
            <h4 class="mb-3">Jaga Keamanan Anda</h4>
            <p>
              Keamanan dan kenyamanan Anda adalah prioritas utama kami, dijamin dengan standar operasional yang terpercaya.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-3 animate-zoom-in delay-3">
        <div class="card pt-4 pb-3 px-2 h-100 shadow-sm rounded-4 border-0">
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
  {{-- Section Our Team --}}
  <section class="container my-5 text-center" id="our-team">
    <h2 class="fw-bold text-center mb-4 animate-fade-in">Tim Kami</h2>
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
            <h5 class="card-title fw-semibold  mb-2 team-name">{{ $team->name }}</h5>
            <p class="card-text text-muted team-desc">{{ $team->description }}</p>
          </div>
          @if(isset($team->socials) && count($team->socials))
          <div class="social-icons mb-3">
            @foreach($team->socials as $social)
              <a href="{{ $social->link }}" target="_blank" class="me-3 text-primary fs-5" title="{{ ucfirst($social->platform) }}">
                <i class="fab fa-{{ strtolower($social->platform) }}"></i>
              </a>
            @endforeach
          </div>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </section>

  {{-- Section Gabung Bersama Traflo (Call to Action) --}}
  <section class="container text-center my-5 py-5 bg-primary text-white rounded shadow-lg">
    <h4 class="fw-bold mb-3">Gabung Bersama Traflo Sekarang!</h4>
    <p class="fs-5 px-md-5 px-3 mb-4">
      Jangan lewatkan kesempatan untuk menjelajahi Flores bersama kami. Buatlah momen berharga dan kenangan indah yang akan Anda ingat sepanjang hidup.
    </p>
    <a href="{{ route('package') }}" class="btn btn-light rounded-pill px-4 py-2 animate-fade-in delay-2">Mulai Petualangan Anda</a>
  </section>

</main>

@endsection

{{-- Additional CSS (could be in app.css or inside a <style> tag) --}}
@push('styles')
<style>
  .main-color {
    color: #28a745; /* hijau segar */
  }
  .title-alt {
    color: #6c757d;
  }
  .animate-fade-in {
    animation: fadeIn 1s ease forwards;
    opacity: 0;
  }
  .animate-fade-in.delay-1 {
    animation-delay: 0.5s;
  }
  .animate-fade-in.delay-2 {
    animation-delay: 1s;
  }
  .animate-slide-left {
    animation: slideInLeft 1s ease forwards;
    opacity: 0;
  }
  .animate-slide-right {
    animation: slideInRight 1s ease forwards;
    opacity: 0;
  }
  .animate-slide-up {
    animation: slideInUp 1s ease forwards;
    opacity: 0;
  }
  .animate-zoom-in {
    animation: zoomIn 0.8s ease forwards;
    opacity: 0;
  }
  .animate-zoom-in.delay-1 {
    animation-delay: 0.3s;
  }
  .animate-zoom-in.delay-2 {
    animation-delay: 0.6s;
  }
  .animate-zoom-in.delay-3 {
    animation-delay: 0.9s;
  }

  /* Team Section */
  .team-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
  }
  .team-photo-wrapper {
    height: 500px;
  }
  .team-photo {
    object-fit: cover;
    height: 100%;
    transition: transform 0.4s ease;
  }
  .team-card:hover .team-photo {
    transform: scale(1.05);
  }
  .team-name {
    transition: color 0.3s ease;
  }
  .team-card:hover .team-name {
    color: #1e7e34; /* hijau gelap */
  }
  .team-desc {
    font-size: 0.95rem;
    min-height: 60px;
  }
  .social-icons a {
    transition: color 0.3s ease;
  }
  .social-icons a:hover {
    color: #1e7e34;
  }

  /* Animations */
  @keyframes fadeIn {
    to { opacity: 1; }
  }
  @keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
  }
  @keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
  }
  @keyframes slideInUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes zoomIn {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
  }
</style>
@endpush