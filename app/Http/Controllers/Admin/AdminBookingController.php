<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    // Menampilkan list user dengan jumlah booking
public function userList()
{
    $users = User::where('is_admin', 0)  // hanya user bukan admin
                ->withCount('bookings')
                ->get();

    return view('admin.user.index', compact('users'));
}

    // Menampilkan detail booking untuk user tertentu (cek booking admin)
    public function userBookings(User $user)
{
    $bookings = Booking::with('travelPackage')
        ->where('email', $user->email)
        ->get();

    return view('admin.user.booking', compact('user', 'bookings'));
}

}
