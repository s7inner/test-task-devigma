<?php

namespace App\Services;

use App\DTO\Bookings\CancelBookingDTO;
use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\GetUserBookingsDTO;
use App\Models\Booking;
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

    /**
     * Create a new booking for a user.
     */
    public function createBooking(CreateBookingDTO $dto): Booking
    {
        return User::findOrFail($dto->user_id)
            ->bookings()
            ->create([
                'date' => $dto->date,
                'time_slot' => $dto->time_slot,
                'status' => Booking::STATUS_BOOKED,
            ]);
    }

    /**
     * Cancel a booking for a user.
     */
    public function cancelBooking(CancelBookingDTO $dto): Booking
    {
        $booking = Booking::where('id', $dto->booking_id)
            ->where('user_id', $dto->user_id)
            ->firstOrFail();

        $booking->update([
            'status' => Booking::STATUS_CANCELLED,
        ]);

        return $booking->fresh();
    }
}
