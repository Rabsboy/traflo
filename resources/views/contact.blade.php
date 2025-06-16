@extends('layouts.app')

@section('content')
<section
    class="hero"
    id="hero"
    style="
        background-image: url('{{ asset('storage/images/cs.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 65vh;
        position: relative;
    "
>
    <div class="hero-content h-100 d-flex justify-content-center align-items-center flex-column text-white text-center" style="background-color: rgba(0, 0, 0, 0.55);">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Hubungi Kami</h1>
        <p class="lead animate__animated animate__fadeInUp">Kami sangat menghargai masukan dan pertanyaan Anda</p>
        <hr width="60" class="border-white animate__animated animate__fadeInUp" />
    </div>
</section>

<main class="container mb-5 position-relative" style="margin-top: -100px; z-index: 2;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 p-5 rounded-4 bg-light animate__animated animate__fadeInUp">
                @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <h3 class="mb-4 text-center text-black fw-semibold">Tinggalkan Pesan Anda</h3>

                <form method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="name" class="form-control rounded-end" id="name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" name="email" class="form-control rounded-end" id="exampleInputEmail1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan Anda</label>
                        <textarea name="message" class="form-control rounded-3" rows="5" id="message" required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill py-2 px-4">
                            <i class="bi bi-send-fill me-2"></i>Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
