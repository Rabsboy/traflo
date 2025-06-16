@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h4 text-gray-800 font-weight-bold">📊 Dashboard Admin Traflo</h2>
    </div>

    <!-- Cards Row -->
    <div class="row">
        <!-- Total Paket Travel -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Paket Travel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                    </div>
                    <i class="fas fa-map-marked-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-sm h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Transaksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransactions }}</div>
                    </div>
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Transaksi Pending -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-sm h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transaksi Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTransactions }}</div>
                    </div>
                    <i class="fas fa-spinner fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Transaksi Sukses -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-sm h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Transaksi Sukses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $successfulTransactions }}</div>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Terbaru -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">📌 Booking Terbaru</h6>
        </div>
        <div class="card-body p-0">
            @if($latestBookings->isEmpty())
                <div class="p-3 text-center text-muted">Belum ada booking terbaru.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama</th>
                                <th>Paket</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestBookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->travelPackage->name }}</td>
                                <td>
                                    <span class="badge 
                                        @if($booking->payment_status === 'verified') bg-success 
                                        @elseif($booking->payment_status === 'pending') bg-warning text-dark 
                                        @else bg-secondary @endif">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
