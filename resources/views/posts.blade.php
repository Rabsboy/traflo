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
      background-image: url('{{ asset('storage/images/blog.jpg') }}');
    "
  >
    <div
      class="hero-content h-100 d-flex justify-content-center align-items-center flex-column"
    >
      <h1 class="display-4 fw-bold text-white animate__animated animate__fadeInDown">
       Blog Kami
      </h1>

      <hr width="40" class="text-center" />
    </div>
  </section>

  <!--=============== Blog ===============-->
  <section class="container my-5 text-center">
    <h2 class="display-6 fw-bold animate__animated animate__fadeInUp">Cerita Perjalanan & Tips Wisata</h2>
    <hr class="mx-auto mb-4" style="width: 60px; border-top: 3px solid #28a745;" />
    <p>Temukan inspirasi dan cerita seru dari para traveler di blog kami!</p>
    <div class="animate__animated animate__fadeInUp row justify-content-center g-4 mt-4">
      @foreach($posts as $post)
      <div class="col-md-6 col-lg-4">
        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
          <div class="card shadow-sm h-100 blog-card animate__animated animate__fadeInUp animate__delay-1s">
  <img 
    src="{{ Storage::url($post->image) }}" 
    alt="{{ $post->title }}" 
    class="card-img-top object-fit-cover" 
    style="height: 180px;"
  >
  <div class="card-body text-start">
    <small class="text-muted">Traflo - {{ $post->created_at->diffForHumans() }}</small>
    <h5 class="card-title mt-2">{{ $post->title }}</h5>
    <p class="card-text text-muted">
      {{ Str::limit(strip_tags($post->content), 100, '...') }}
    </p>
  </div>
</div>

        </a>
      </div>
      @endforeach
    </div>
  </section>
</main>
@endsection

@push('style-alt')
<style>
  .blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
  }
</style>
@endpush
