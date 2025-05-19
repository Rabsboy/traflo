@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Cek Booking Anda</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('booking.check') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="email">Masukkan Email Anda</label>
            <input type="email" name="email" id="email" class="form-control" required
                value="{{ old('email') }}">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Cari Booking</button>
    </form>

    @if(isset($bookings))
        <h4>Hasil Booking untuk email: {{ request('email') }}</h4>
        @if($bookings->isEmpty())
            <p>Tidak ada booking ditemukan.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Nama Paket</th>
                        <th>Status Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Tanggal Booking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_code }}</td>
                        <td>{{ $booking->travelPackage->name }}</td>
                        <td>{{ ucfirst($booking->payment_status) }}</td>
                        <td>IDR {{ number_format($booking->travelPackage->price) }}</td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
