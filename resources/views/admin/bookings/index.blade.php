@extends('admin.layout')

@section('content')
<style>
    .container.mt-5 {
        max-width: 1100px;
    }

    .table th, .table td {
        vertical-align: middle;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .form-select-sm {
        min-width: 110px;
    }

    .action-buttons form {
        display: inline-block;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.4em 0.6em;
        border-radius: 0.35rem;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f5f9;
    }

    .action-buttons form + form {
        margin-top: 0.3rem;
    }

    .filter-form {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
</style>

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-4">📋 Daftar Booking</h4>

            <form method="GET" action="{{ route('admin.bookings') }}" class="filter-form">
                <label for="filter_status" class="form-label mb-0">Filter Status:</label>
                <select name="status" id="filter_status" class="form-select form-select-sm" style="max-width: 160px;">
                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                @if(request('status'))
                    <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-secondary">Reset</a>
                @endif
            </form>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Paket Travel</th>
                            <th>Tgl Keberangkatan</th>
                            <th>Metode Pembayaran</th>
                            <th>Kode Booking</th>
                            <th>Tanggal Booking</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->travelPackage->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}</td>
                                <td>{{ ucfirst(str_replace('-', ' ', $booking->payment_method)) }}</td>
                                <td><code>{{ $booking->booking_code }}</code></td>
                                <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    @php
                                        $status = strtolower($booking->payment_status);
                                        $badgeClass = match($status) {
                                            'verified' => 'success',
                                            'pending' => 'warning',
                                            'cancelled' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                </td>
                                <td class="action-buttons text-center" style="min-width: 160px;">
                                    @if($booking->payment_status !== 'cancelled')
                                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline-flex align-items-center mb-1" style="gap: 0.4rem;">
                                            @csrf
                                            <select name="payment_status" class="form-select form-select-sm" aria-label="Status pembayaran">
                                                <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="verified" {{ $booking->payment_status === 'verified' ? 'selected' : '' }}>Verified</option>
                                                <option value="cancelled" {{ $booking->payment_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>

                                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="d-block">
                                            @csrf
                                            <input type="hidden" name="payment_status" value="cancelled">
                                            <button type="submit" class="btn btn-sm btn-danger w-100" 
                                                onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                                <i class="bi bi-x-circle me-1"></i> Batalkan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small fst-italic">Sudah dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-4">Belum ada booking yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- /.table-responsive -->
        </div>
    </div>
</div>
@endsection
