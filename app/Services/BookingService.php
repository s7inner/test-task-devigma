<?php

namespace App\Services;

use App\DTO\Bookings\GetUserBookingsDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    /**
     * Get all bookings for a specific user ordered by date and time.
     */
    public function getUserBookings(GetUserBookingsDTO $dto): Collection
    {
        return User::findOrFail($dto->user_id)
            ->bookings()
            ->orderBy('date', 'desc')
            ->orderBy('time_slot', 'desc')
            ->get();
    }
}
