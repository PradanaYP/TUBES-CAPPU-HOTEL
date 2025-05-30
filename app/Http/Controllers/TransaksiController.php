<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\Rooms;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function show($id)
    {
        $reservations = Reservations::with('room.roomTypes')
            ->where('guest_id', $id)
            ->get();

        return view('history', compact('reservations'));
    }

    public function store(Request $request)
    {
       try {
            $request->validate([
                'room_id' => 'required|exists:rooms,id',
                'checkin' => 'required|date|after_or_equal:today',
                'checkout' => 'required|date|after:checkin',
                'guests' => 'required|integer|min:1',
            ]);
            
            $reservation = Reservations::create([
                'guest_id' => Auth::id(),
                'room_id' => $request->room_id,
                'check_in' => $request->checkin,
                'check_out' => $request->checkout,
                'guests' => $request->guests,
            ]);

            Rooms::where('id', $request->room_id)->update(['status' => 'booked']);

            return redirect()->route('payment.show', $reservation->res_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function index()
    {
        $reservations = Reservations::with(['rooms.roomTypes'])
            ->where('guest_id', Auth::id())
            ->get();

        return view('history', compact('reservations'));
    }

}
