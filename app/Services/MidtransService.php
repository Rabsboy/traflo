<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($params)
    {
        try {
            // Buat transaksi dengan Midtrans Snap API
            $snap = Snap::createTransaction($params);

            // Pastikan snap mengembalikan objek, bukan array
            return $snap;
        } catch (\Exception $e) {
            // Kembalikan pesan kesalahan jika gagal
            return ['error' => $e->getMessage()];
        }
    }
}