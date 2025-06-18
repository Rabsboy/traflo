@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 text-gray-800">
            📄 Booking untuk: <strong>{{ $user->name }}</strong> ({{ $user->email }})
        </h4>
    </div>

    @if($bookings->isEmpty())
        <div class="alert alert-warning">
            User ini belum melakukan booking.
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Paket</th>
                                <th>Tanggal Keberangkatan</th>
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
                                    <td>
                                        @if($booking->departure_date)
                                            {{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}
                                        @else
                                            <span class="text-muted fst-italic">Belum ditentukan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $status = strtolower($booking->payment_status);
                                            $badgeClass = match($status) {
                                                'verified' => 'badge bg-success',
                                                'pending' => 'badge bg-warning text-dark',
                                                'cancelled' => 'badge bg-danger',
                                                default => 'badge bg-secondary',
                                            };
                                        @endphp
                                        <span class="{{ $badgeClass }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td>IDR {{ number_format($booking->travelPackage->price, 0, ',', '.') }}</td>
                                    <td>{{ $booking->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
