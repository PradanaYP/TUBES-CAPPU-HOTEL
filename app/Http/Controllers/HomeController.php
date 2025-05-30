<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room_Types;

class HomeController extends Controller
{
    public function index()
    {
        $roomTypes = Room_Types::all();

        return view('homepage', compact('roomTypes'));
    }

    public function show($id)
    {
        $roomType = Room_Types::with('rooms')->findOrFail($id);
        return view('detail_room', compact('roomType'));
    }
}
