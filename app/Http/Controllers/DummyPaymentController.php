<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MidtransService;
use App\Models\Booking;

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
    ]);

    $orderId = uniqid('order-');

    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $request->amount,
        ],
        'customer_details' => [
            'first_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ],
    ];

    try {
        $transaction = $this->midtrans->createTransaction($params);

        if (isset($transaction->token)) {
            Booking::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'travel_package_id' => $request->travel_package_id,
                'payment_method' => 'Midtrans',
                'booking_code' => $orderId,
                'payment_status' => 'pending', 
            ]);

            return response()->json(['snapToken' => $transaction->token]);
        }

        return response()->json(['error' => 'Gagal mendapatkan token pembayaran.'], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
