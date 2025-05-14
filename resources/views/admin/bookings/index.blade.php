@extends('admin.layout')

@section('content')
    <div class="container mt-5">
        <h2>Daftar Booking</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Paket Travel</th>
                    <th>Metode Pembayaran</th>
                    <th>Tanggal Booking</th>
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
                        <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
