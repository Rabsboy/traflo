@extends('layouts.app')

@section('content')
    <main>
      <!--=============== HOME ===============-->
      <section
        class="hero"
        id="hero"
        style="
          background-repeat: no-repeat;
          background-size: cover;
          height: 50vh;
          background-image: url('{{ asset('storage/images/bg.jpg') }}');
        "
      >
        <div
          class="hero-content h-100 d-flex justify-content-center align-items-center flex-column"
        >
          <h1 class="display-4 fw-bold text-white animate__animated animate__fadeInDown">Paket Travel</h1>
          <hr width="40" class="text-center" />
        </div>
      </section>

      <!--=============== Package Travel ===============-->

      
      <section class="container package text-center" id="package" style="margin-top: -60px">
  <h2 class="display-6 fw-bold animate__animated animate__fadeInUp">Paket Travel Terbaik</h2>
  <p class="display-10 fw-bold animate__animated animate__fadeInUp text-muted">Nikmati pengalaman tak terlupakan bersama Traflo ke destinasi impian Anda</p>
  <div class="row justify-content-center">
    @foreach($travelPackages as $travelPackage)
      <div class="animate__animated animate__fadeInUp animate__delay-1s col-md-6 col-lg-4 col-xl-3 mb-5">
        <div class="card shadow-sm border-0 h-100 hover-shadow transition rounded-4 overflow-hidden">
          <a href="{{ route('detail', $travelPackage->id) }}" class="text-decoration-none text-dark">
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
              <p class="text-muted mb-0" style="font-size: 0.9rem;">
                Ayo ikut perjalanan seru ke destinasi {{ $travelPackage->name }} sekarang!
              </p>
            </div>
          </a>
        </div>
      </div>
    @endforeach
  </div>
</section>

    </main>
@endsection
<style>/* Tambahan untuk efek hover */
.hover-shadow:hover {
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
  transform: translateY(-5px);
  transition: all 0.3s ease-in-out;
}

.transition {
  transition: all 0.3s ease-in-out;
}
</style>