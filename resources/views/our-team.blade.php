@extends('layouts.app')

@section('title', 'Our Team')

@section('content')
<section class="our-team-section py-5 bg-light">
    <div class="container">
        <h2 class="mb-5 text-center fw-bold main-color">Our Team</h2>

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
                        <h5 class="card-title fw-semibold text-primary mb-2 team-name">{{ $team->name }}</h5>
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
    </div>
</section>
@endsection

@push('style-alt')
<style>
    .main-color {
        color: #2c3e50;
        font-family: 'Poppins', sans-serif;
    }

    .our-team-section {
        background: #f7f9fc;
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

    .team-photo {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }

    .team-card:hover .team-photo {
        transform: scale(1.1);
    }

    .card-title.team-name {
        font-size: 1.4rem;
        transition: color 0.3s ease;
    }

    .team-card:hover .team-name {
        color: #1abc9c;
    }

    .card-text.team-desc {
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
