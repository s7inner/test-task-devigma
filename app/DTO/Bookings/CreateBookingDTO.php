<?php

namespace App\DTO\Bookings;

use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class CreateBookingDTO extends Data
{
    public function __construct(
        #[Required]
        public int $user_id,

        #[Required, Date, DateFormat('Y-m-d')]
        public string $date,

        #[Required]
        public string $time_slot
    ) {}
}
