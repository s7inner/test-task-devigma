<?php

namespace App\Http\Requests\Api;

use App\Contracts\DataRequestInterface;
use App\DTO\Bookings\CreateBookingDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest implements DataRequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date|after:today',
            'time_slot' => [
                'required',
                'string',
                'in:09:00,10:00,11:00,12:00,13:00,14:00,15:00,16:00',
                'unique:bookings,time_slot,NULL,id,date,'.$this->input('date').',status,booked',
            ],
        ];
    }

    /**
     * Get the DTO from the request.
     */
    public function getDto(): CreateBookingDTO
    {
        return CreateBookingDTO::from([
            'user_id' => $this->user()->id,
            'date' => $this->input('date'),
            'time_slot' => $this->input('time_slot'),
        ]);
    }
}
