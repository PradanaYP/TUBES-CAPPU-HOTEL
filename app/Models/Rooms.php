<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $fillable = [
        'roomtype_id',
        'room_number',
        'status'
    ];

    public function roomTypes()
    {
        return $this->belongsTo(Room_Types::class, 'roomtype_id');
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'room_id');
    }
}
