@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeInUp">
                <div class="card-body p-5">

                    <h2 class="mb-4 text-center fw-bold">📋 Riwayat Booking Anda</h2>

                    @if(!Auth::check())
                        <div class="text-center">
                            <img src="{{ asset('images/login-promt.jpg') }}" alt="Login Illustration" class="mb-3" style="max-width: 300px;">
                            <p class="lead">Silakan <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">LOGIN</a> untuk melihat riwayat booking Anda.</p>
                        </div>
                    @else
                        @if(Auth::user()->is_admin)
                            <div class="text-center">
                                <h4 class="mb-3">Anda adalah Administrator</h4>
                                <p class="lead text-muted">Halaman ini hanya untuk customer. Silakan akses halaman admin Anda.</p>
                                <a href="{{ route('admin.bookings') }}" class="btn btn-primary mt-3">
                                    🔧 Lihat Daftar Booking Customer
                                </a>
                            </div>
                        @elseif($bookings->isEmpty())
                            <div class="text-center">
                                <h4 class="mb-3">Belum ada booking</h4>
                                <p class="lead text-muted">
                                    Kamu belum melakukan booking dengan email <strong>{{ Auth::user()->email }}</strong>.
                                </p>
                                <a href="{{ route('package') }}" class="btn btn-success mt-3">Lakukan Booking Sekarang</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle rounded-3 overflow-hidden">
                                    <thead class="table-primary text-white">
                                        <tr>
                                            <th>Kode Booking</th>
                                            <th>Nama Paket</th>
                                            <th>Status</th>
                                            <th>Harga</th>
                                            <th>Tanggal Booking</th>
                                            <th>Keberangkatan</th>
                                            <th>cetak invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                        <tr>
                                            <td><span class="fw-semibold">{{ $booking->booking_code }}</span></td>
                                            <td>{{ $booking->travelPackage->name }}</td>
                                            <td>
                                                @php
                                                    $status = $booking->payment_status;
                                                    $badgeClass = match($status) {
                                                        'pending' => 'warning',
                                                        'verified' => 'success',
                                                        'cancelled' => 'danger',
                                                        default => 'secondary',
                                                    };
                                                    $icon = match($status) {
                                                        'pending' => '⏳',
                                                        'verified' => '✅',
                                                        'cancelled' => '❌',
                                                        default => 'ℹ️',
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $badgeClass }} rounded-pill px-3 py-2">
                                                    {{ $icon }} {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                            <td>IDR {{ number_format($booking->travelPackage->price) }}</td>
                                            <td>{{ $booking->created_at->format('d M Y') }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}
                                            </td>
                                            <td><div class="text-end mt-4">
    <a href="{{ route('booking.invoice.pdf', $booking->id) }}" class="btn btn-outline-danger">
        🧾 Unduh PDF Invoice
    </a>
</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
