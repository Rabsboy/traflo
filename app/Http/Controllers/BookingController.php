<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
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
public function bookingSuccess($id)
{
    // Attempt to find the booking by ID
    $booking = Booking::find($id);

    // Check if the booking exists
    if (!$booking) {
        // If not found, redirect with an error message
        return redirect()->route('home')->with('error', 'Booking not found.');
    }

    // Pass the booking data to the view
    return view('booking.success', compact('booking'));
}
    public function index()
    {
        $bookings = Booking::with('travelPackage')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

}
