@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h2>Daftar Booking</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Paket Travel</th>
                <th>Metode Pembayaran</th>
                <th>Kode Booking</th>
                <th>Tanggal Booking</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->travelPackage->name }}</td>
                    <td>{{ ucfirst(str_replace('-', ' ', $booking->payment_method)) }}</td>
                    <td>{{ $booking->booking_code }}</td>
                    <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <span class="badge 
                            @if($booking->payment_status === 'pending') bg-warning 
                            @elseif($booking->payment_status === 'verified') bg-success 
                            @else bg-danger 
                            @endif">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <select name="payment_status" class="form-select form-select-sm me-2" style="width: auto;" 
                                @if($booking->payment_status === 'cancelled') disabled @endif>
                                <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="verified" {{ $booking->payment_status === 'verified' ? 'selected' : '' }}>Verified</option>
                                <option value="cancelled" {{ $booking->payment_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary" 
                                @if($booking->payment_status === 'cancelled') disabled @endif>Update</button>
                        </form>

                        @if($booking->payment_status !== 'cancelled')
                            <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="mt-1">
                                @csrf
                                <input type="hidden" name="payment_status" value="cancelled">
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                    <i class="bi bi-x-circle"></i> Batalkan
                                </button>
                            </form>
                        @else
                            <span class="text-muted">Sudah dibatalkan</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
