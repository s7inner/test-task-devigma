<?php

namespace App\DTO\Bookings;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class CancelBookingDTO extends Data
{
    public function __construct(
        #[Required]
        public int $user_id,

        #[Required]
        public int $booking_id
    ) {}
}
