<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if( Auth::id()){
            Booking::create([
                'user_id' => Auth::id(),
                'room_id' => $validated['room_id'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);
            return redirect()->back()->with('success', 'Room booked successfully!');
        }
        return redirect()->back()->with('error', 'Room not booked, try login.');

    }
}
