<?php

namespace App\DTO\Bookings;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class GetUserBookingsDTO extends Data
{
    public function __construct(
        #[Required]
        public int $user_id
    ) {}
}
