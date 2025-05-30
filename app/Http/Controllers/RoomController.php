<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Room_Types;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index($roomTypeId)
    {
        $roomType = Room_Types::findOrFail($roomTypeId);
        $availableRooms = Rooms::where('roomtype_id', $roomTypeId)
                            ->where('status', 'available')
                            ->get();

        return view('roomselection', compact('availableRooms', 'roomType'));
    }
}
