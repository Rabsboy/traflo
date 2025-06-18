<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TravelPackage;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DepartureSchedule;

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
            'departure_date'=>'required|date',

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
            'user_id' => Auth::id(),
            'departure_date' => $request->departure_date,
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

   public function index(Request $request)
{
    $query = Booking::with('travelPackage');

    if ($request->filled('status')) {
        $status = $request->input('status');
        if (in_array($status, ['pending', 'verified', 'cancelled'])) {
            $query->where('payment_status', $status);
        }
    }

    $bookings = $query->get();

    return view('admin.bookings.index', compact('bookings'));
}

    public function showCheckBookingForm()
{
    $userEmail = auth()->check() ? auth()->user()->email : null;
    $bookings = null;

    if ($userEmail) {
        $bookings = Booking::with('travelPackage')
                    ->where('email', $userEmail)
                    ->get();
    }

    return view('cek-booking', compact('bookings'));
}

    public function checkBooking(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    $bookings = Booking::with('travelPackage')
                ->where('email', $user->email)
                ->get();

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
        public function userBookings($userId)
    {
        $user = User::with('bookings.travelPackage')->findOrFail($userId);
        $bookings = $user->bookings;

        return view('admin.user.bookings', compact('user', 'bookings'));
    }

public function downloadPdf($id)
{
    $booking = Booking::with('travelPackage')->findOrFail($id);

    // Pastikan user hanya bisa download miliknya sendiri (opsional tapi aman)
    if ($booking->email !== Auth::user()->email) {
        abort(403, 'Unauthorized access to invoice.');
    }

    $user = Auth::user();

    $pdf = PDF::loadView('invoice', compact('user', 'booking'));
    return $pdf->download('invoice-booking-' . $booking->booking_code . '.pdf');
}


}
