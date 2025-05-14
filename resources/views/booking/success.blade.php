@extends('layouts.app')

@section('content')
<main>
    <div class="container mt-5">
        <div class="alert alert-success">
            <h4 class="alert-heading">Booking Successful!</h4>
            <p>Your booking for the package <strong>{{ $booking->travelPackage->name }}</strong> has been successfully confirmed. We will reach out to you soon.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Go Back to Home</a>
        </div>
    </div>
</main>
@endsection
