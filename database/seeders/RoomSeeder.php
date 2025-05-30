<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rooms;
use App\Models\Room_Types;


class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deluxe = Room_Types::where('type_name', 'Deluxe')->first();
        $standard = Room_Types::where('type_name', 'Standard')->first();
        $suite = Room_Types::where('type_name', 'Suite')->first();

        Rooms::create([
            'roomtype_id' => $deluxe->id,
            'room_number' => '101',
            'status' => 'available'
        ]);

        Rooms::create([
            'roomtype_id' => $standard->id,
            'room_number' => '201',
            'status' => 'available'
        ]);
        Rooms::create([
            'roomtype_id' => $suite->id,
            'room_number' => '301',
            'status' => 'available'
        ]);
    }
}
