<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $primaryKey = 'res_id';
    protected $fillable = ['guest_id', 'room_id', 'check_in', 'check_out', 'guests', 'status'];
    
    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }
    
    public function rooms()
    {
        return $this->belongsTo(Rooms::class,  'room_id');
    }

    public function payments()
    {
        return $this->hasOne(Payments::class, 'reservation_id', 'res_id');
    }
}
