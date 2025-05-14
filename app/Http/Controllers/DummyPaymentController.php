<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DummyPaymentController extends Controller
{
    public function process(Request $request)
    {
        // Data transaksi dummy
        $paymentStatus = ['success', 'pending', 'failed'];
        $status = $paymentStatus[array_rand($paymentStatus)];

        // Data hasil pembayaran
        $result = [
            'order_id' => uniqid(),
            'gross_amount' => $request->amount,
            'status' => $status,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
        ];

        // Tampilkan halaman hasil pembayaran
        return view('payment.result', ['result' => $result]);
    }

    public function form()
    {
        return view('payment.form');
    }

public function storeBooking(Request $request, $id)
{
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'payment_method' => 'required|string',
    ]);

    // Create a new booking entry
    $booking = new Booking([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'travel_package_id' => $id,  // This assumes you have the package ID
        'payment_method' => $request->payment_method,
    ]);

    // Save the booking
    $booking->save();

    // Redirect or show confirmation page
    return redirect()->route('booking.success', ['id' => $booking->id]);  // Assuming a success page
}

}