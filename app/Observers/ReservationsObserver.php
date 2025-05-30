<?php

namespace App\Observers;

use App\Models\Reservations;
use App\Models\Rooms;

class ReservationsObserver
{
    /**
     * Handle the Reservations "created" event.
     */
    public function created(Reservations $reservations): void
    {
        //
    }

    /**
     * Handle the Reservations "updated" event.
     */
   public function updated(Reservations $reservation)
    {
        if (in_array($reservation->status, ['checked_out', 'cancelled'])) {
            Rooms::where('id', $reservation->room_id)->update(['status' => 'available']);
        }
    }

    /**
     * Handle the Reservations "deleted" event.
     */
    public function deleted(Reservations $reservations): void
    {
        //
    }

    /**
     * Handle the Reservations "restored" event.
     */
    public function restored(Reservations $reservations): void
    {
        //
    }

    /**
     * Handle the Reservations "force deleted" event.
     */
    public function forceDeleted(Reservations $reservations): void
    {
        //
    }
}
