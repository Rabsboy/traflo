<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TravelPackage;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.index',[
        'totalProducts' => \App\Models\TravelPackage::count(),
        'totalTransactions' => \App\Models\Booking::count(),
        'pendingTransactions' => \App\Models\Booking::where('payment_status', 'pending')->count(),
        'successfulTransactions' => \App\Models\Booking::where('payment_status', 'verified')->count(),
        'latestBookings' => Booking::with('travelPackage')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get(),
    ]);
    }
}
