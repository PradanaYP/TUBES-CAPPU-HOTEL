<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'amount',
        'card_number',
        'payment_date',
    ];

    public function reservation()
    {
       return $this->belongsTo(Reservations::class, 'reservation_id', 'res_id');
    }
}
