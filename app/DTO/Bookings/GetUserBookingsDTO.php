<?php

namespace App\DTO\Bookings;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;

class GetUserBookingsDTO extends Data
{
    public function __construct(
        #[Required]
        public int $user_id
    ) {}
}
