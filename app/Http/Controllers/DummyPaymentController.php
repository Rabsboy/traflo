<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MidtransService;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DummyPaymentController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

   public function process(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'amount' => 'required|numeric|min:1',
        'travel_package_id' => 'required|exists:travel_packages,id',
        'departure_date' => [
    'required',
    'date',
    Rule::exists('departure_schedules', 'departure_date')
        ->where(fn ($query) => $query->where('travel_package_id', $request->travel_package_id)),
],

    ]);

    $orderId = uniqid('order-');

    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => (int) $request->amount,
        ],
        'customer_details' => [
            'first_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ],
    ];

    try {
        Log::info('Midtrans Params:', $params); // Log data sebelum request
        $transaction = $this->midtrans->createTransaction($params);

        if (isset($transaction->token)) {
            Booking::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'travel_package_id' => $request->travel_package_id,
                'payment_method' => 'Midtrans',
                'booking_code' => $orderId,
                'payment_status' => 'pending',
                'departure_date' => $request->departure_date,
            ]);

            return response()->json(['snapToken' => $transaction->token]);
        }

        return response()->json(['error' => 'Gagal mendapatkan token pembayaran.'], 500);
    } catch (\Exception $e) {
        Log::error('Midtrans Error:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'params' => $params
        ]);

        return response()->json([
            'error' => 'Gagal mendapatkan token pembayaran.',
            'message' => $e->getMessage(),
        ], 500);
    }
}
public function updateStatus(Request $request)
{
    $request->validate([
        'order_id' => 'required|string',
        'transaction_status' => 'required|string',
    ]);

    $booking = Booking::where('booking_code', $request->order_id)->first();

    if ($booking) {
        $statusMap = [
            'settlement' => 'verified',
            'capture' => 'verified',
            'pending' => 'pending',
            'deny' => 'failed',
            'expire' => 'expired',
            'cancel' => 'cancelled',
        ];

        $booking->payment_status = $statusMap[$request->transaction_status] ?? 'pending';
        $booking->save();

        return response()->json(['message' => 'Status updated']);
    }

    return response()->json(['error' => 'Booking not found'], 404);
}


}
