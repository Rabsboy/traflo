<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartureSchedule;

class DepartureScheduleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'travel_package_id' => 'required|exists:travel_packages,id',
            'departure_date' => 'required|date',
        ]);

        DepartureSchedule::create([
            'travel_package_id' => $request->travel_package_id,
            'departure_date' => $request->departure_date,
        ]);

        return back()->with('message', 'Tanggal keberangkatan berhasil ditambahkan.');
    }

    public function destroy(DepartureSchedule $schedule)
    {
        $schedule->delete();

        return back()->with('message', 'Tanggal keberangkatan berhasil dihapus.');
    }
}
