<?php

namespace App\Http\Requests\Api;

use App\Contracts\DataRequestInterface;
use App\DTO\Bookings\CancelBookingDTO;
use Illuminate\Foundation\Http\FormRequest;

class CancelBookingRequest extends FormRequest implements DataRequestInterface
{
    /**
     * Get the DTO from the request.
     */
    public function getDto(): CancelBookingDTO
    {
        return CancelBookingDTO::from([
            'user_id' => $this->user()->id,
            'booking_id' => (int) $this->route('id'),
        ]);
    }
}
