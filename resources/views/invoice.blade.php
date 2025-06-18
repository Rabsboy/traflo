<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to bottom right, #e0f7fa, #fff);
            color: #333;
        }

        .invoice-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            max-width: 800px;
            margin: auto;
            border: 2px solid #2196f3;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #2196f3;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            color: #0d47a1;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #bbdefb;
            color: #0d47a1;
            width: 200px;
        }

        td {
            background-color: #f9f9f9;
        }

        .package-image {
            margin-top: 25px;
            text-align: center;
        }

        .package-image img {
            max-width: 30%;
            height: auto;
            border-radius: 10px;
            border: 2px solid #2196f3;
        }

        .terms {
            margin-top: 30px;
            background-color: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            color: #0d47a1;
        }

        .terms h4 {
            margin-top: 0;
            font-size: 16px;
            border-bottom: 1px solid #90caf9;
            padding-bottom: 5px;
        }

        .terms ul {
            padding-left: 20px;
        }

        .terms li {
            margin-bottom: 8px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-style: italic;
            color: #0d47a1;
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
        }

        .status-paid {
            color: #2e7d32;
            font-weight: bold;
        }

        .status-pending {
            color: #f57c00;
            font-weight: bold;
        }

        .status-failed {
            color: #c62828;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h2>🧾 Invoice Booking - Traflo</h2>
            @if($booking->travelPackage->galleries && $booking->travelPackage->galleries->first())
                <div class="package-image">
                    <img src="{{ public_path('storage/' . $booking->travelPackage->galleries->first()->path) }}" alt="Gambar Paket">
                </div>
            @endif
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Tanggal Cetak:</strong> {{ now()->format('d M Y') }}</p>
        </div>

        <table>
            <tr>
                <th>Kode Booking</th>
                <td>{{ $booking->booking_code }}</td>
            </tr>
            <tr>
                <th>Nama Paket</th>
                <td>{{ $booking->travelPackage->name }}</td>
            </tr>
            <tr>
                <th>Tanggal Keberangkatan</th>
                <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>IDR {{ number_format($booking->travelPackage->price) }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td class="
                    @if($booking->payment_status === 'verified') status-paid
                    @elseif($booking->payment_status === 'pending') status-pending
                    @else status-failed @endif">
                    {{ ucfirst($booking->payment_status) }}
                </td>
            </tr>
            <tr>
                <th>Tanggal Booking</th>
                <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</td>
            </tr>
        </table>

        <div class="terms">
            <h4>Syarat dan Ketentuan Traflo</h4>
            <ul>
                <li>Pembayaran dinyatakan sah jika telah diverifikasi oleh admin Traflo.</li>
                <li>Peserta wajib membawa identitas saat keberangkatan.</li>
                <li>Traflo tidak bertanggung jawab atas kerugian pribadi selama perjalanan.</li>
                <li>Harga dapat berubah sewaktu-waktu sesuai kebijakan Traflo.</li>
            </ul>
        </div>

        <div class="footer">
            🌴 Terima kasih telah melakukan booking di <strong>Traflo</strong>! Selamat berlibur ✈️
        </div>
    </div>
</body>
</html>
