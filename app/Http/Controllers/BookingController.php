<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TravelPackage;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function storeBooking(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        // Validasi apakah travel package ada
        $travelPackage = TravelPackage::find($id);
        if (!$travelPackage) {
            return back()->with('error', 'Paket travel tidak ditemukan.');
        }

        $bookingCode = 'TRF-' . strtoupper(uniqid());

        // Buat booking tanpa order_id
        $booking = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'travel_package_id' => $id,
            'payment_method' => $request->payment_method,
            'booking_code' => $bookingCode,
            'payment_status' => 'pending',
        ]);

        // Setup konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat params transaksi
        $params = [
            'transaction_details' => [
                'order_id' => 'TRF-' . $booking->id . '-' . uniqid(),
                'gross_amount' => $travelPackage->price,
            ],
            'customer_details' => [
                'first_name' => $booking->name,
                'email' => $booking->email,
                'phone' => $booking->phone,
            ],
                'finish_redirect_url' => route('booking.check'),
        ];

        try {
            $snap = Snap::createTransaction($params);
            $snapToken = $snap->token;
            $redirectUrl = $snap->redirect_url;

            // Update booking dengan order_id
            $booking->order_id = $params['transaction_details']['order_id'];
            $booking->save();

            return redirect($redirectUrl);
        } catch (\Exception $e) {
            Log::error('Midtrans error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function midtransNotification(Request $request)
    {
        $notif = $request->all();

        // Validasi data notifikasi
        if (!isset($notif['order_id'], $notif['transaction_status'])) {
            Log::warning('Midtrans: Data notifikasi tidak lengkap.', $notif);
            return response('Data notifikasi tidak lengkap', 400);
        }

        $orderId = $notif['order_id'];
        $transactionStatus = $notif['transaction_status'];
        $fraudStatus = $notif['fraud_status'] ?? null;

        $booking = Booking::where('order_id', $orderId)->first();

        if (!$booking) {
            Log::warning("Booking tidak ditemukan dengan order_id: {$orderId}");
            return response('Booking tidak ditemukan', 404);
        }

        try {
            switch ($transactionStatus) {
                case 'capture':
                    if ($fraudStatus == 'challenge') {
                        $booking->payment_status = 'pending';
                    } elseif ($fraudStatus == 'accept') {
                        $booking->payment_status = 'verified';
                    }
                    break;
                case 'settlement':
                    $booking->payment_status = 'verified';
                    break;
                case 'pending':
                    $booking->payment_status = 'pending';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $booking->payment_status = 'cancelled';
                    break;
            }

            $booking->save();
            Log::info("Status pembayaran diperbarui: {$transactionStatus} untuk order_id: {$orderId}");

            return response('OK', 200);
        } catch (\Exception $e) {
            Log::error("Gagal memproses notifikasi Midtrans: " . $e->getMessage());
            return response('Gagal memproses notifikasi', 500);
        }
    }

    public function index()
    {
        $bookings = Booking::with('travelPackage')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function showCheckBookingForm()
    {
        return view('cek-booking');
    }

    public function checkBooking(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $bookings = Booking::with('travelPackage')->where('email', $request->email)->get();

        if ($bookings->isEmpty()) {
            return back()->with('error', 'Tidak ada booking dengan email tersebut.');
        }

        return view('cek-booking', compact('bookings'));
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,verified,cancelled',
        ]);

        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        $booking->payment_status = $request->payment_status;
        $booking->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
