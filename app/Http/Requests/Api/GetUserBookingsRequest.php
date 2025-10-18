<?php

namespace App\Http\Requests\Api;

use App\Contracts\DataRequestInterface;
use App\DTO\Bookings\GetUserBookingsDTO;
use Illuminate\Foundation\Http\FormRequest;

class GetUserBookingsRequest extends FormRequest implements DataRequestInterface
{
    /**
     * Get the DTO from the request.
     */
    public function getDto(): GetUserBookingsDTO
    {
        return GetUserBookingsDTO::from([
            'user_id' => $this->user()->id,
        ]);
    }
}
