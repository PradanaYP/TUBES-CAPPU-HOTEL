<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($res_id)
    {
        $reservation = Reservations::with('rooms.roomTypes')->findOrFail($res_id);
        return view('payment', compact('reservation'));
    }

    public function store(Request $request, $res_id)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        $reservation = Reservations::findOrFail($res_id);

        Payments::create([
            'reservation_id' => $reservation->res_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'paid',
        ]);

        return redirect()->route('homepage')->with('success', 'Payment successful!');
    }
}

