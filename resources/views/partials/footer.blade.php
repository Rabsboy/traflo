@php
    $footer = \App\Models\Setting::where('key', 'footer_data')->first();
    $footerData = $footer ? json_decode($footer->value, true) : [];
@endphp

<footer class="footer-section py-5 border-top">
  <div class="container">
    <div class="row align-items-start gy-4">
      <div class="col-lg-4 text-center text-lg-start">
        <a href="{{ route('home') }}" aria-label="Home">
          <img
            width="220"
            height="70"
            class="img-fluid mb-3"
            style="object-fit: contain"
            src="{{ asset('frontend/assets/images/logo-transparent.png') }}"
            alt="Traflo Logo"
          />
        </a>
        <p class="footer-tagline">{{ $footerData['tagline'] ?? 'EASY TRAVEL TO FLORES' }}</p>
      </div>

      <div class="col-lg-4 text-center text-lg-start">
        <h5 class="footer-title">Social Media</h5>
        <ul class="list-unstyled footer-list d-flex flex-column gap-2 align-items-center align-items-lg-start">
          @if(!empty($footerData['facebook']))
            <li>
              <a href="{{ $footerData['facebook'] }}" target="_blank" rel="noopener">
                <i class="fab fa-facebook-f me-2"></i> Facebook
              </a>
            </li>
          @endif
          @if(!empty($footerData['instagram']))
            <li>
              <a href="{{ $footerData['instagram'] }}" target="_blank" rel="noopener">
                <i class="fab fa-instagram me-2"></i> Instagram
              </a>
            </li>
          @endif
          @if(!empty($footerData['youtube']))
            <li>
              <a href="{{ $footerData['youtube'] }}" target="_blank" rel="noopener">
                <i class="fab fa-youtube me-2"></i> YouTube
              </a>
            </li>
          @endif
        </ul>
      </div>

      <div class="col-lg-4 text-center text-lg-start">
        <h5 class="footer-title">Kontak Kami</h5>
        <ul class="list-unstyled footer-list d-flex flex-column gap-2 align-items-center align-items-lg-start">
          @if(!empty($footerData['email']))
            <li>
              <a href="mailto:{{ $footerData['email'] }}">
                <i class="fas fa-envelope me-2"></i> {{ $footerData['email'] }}
              </a>
            </li>
          @endif
          <li>
            <i class="fas fa-map-marker-alt me-2"></i>
            <span>{{ $footerData['address'] ?? 'Nusa Tenggara Timur, Indonesia' }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!-- Font Awesome CDN -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
/>

<style>
  .footer-section {
    background-color: #f8f9fa;
    color: #2d2d2d;
  }

  .footer-title {
    font-weight: 700;
    font-size: 1.2rem;
    color: #3a3a3a;
    margin-bottom: 1rem;
  }

  .footer-tagline {
    font-size: 1rem;
    color: #555;
    font-weight: 500;
  }

  .footer-list li {
    margin-bottom: 0.5rem;
  }

  .footer-list a {
    color: #61bc48;
    text-decoration: none;
    transition: color 0.3s;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
  }

  .footer-list a:hover {
    color: #4e9e39;
    text-decoration: underline;
  }

  .footer-list i {
    color: #61bc48;
    min-width: 20px;
    font-size: 1rem;
  }

  .footer-section .border-top {
    border-top: 2px solid #e0e0e0 !important;
  }

  @media (max-width: 576px) {
    .footer-section {
      text-align: center;
    }

    .footer-list {
      align-items: center !important;
    }
  }
</style>
