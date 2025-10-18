<?php

namespace App\Http\Requests\Api;

use App\Contracts\DataRequestInterface;
use App\DTO\Bookings\GetUserBookingsDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GetUserBookingsRequest extends FormRequest implements DataRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // No validation needed for GET request
        ];
    }

    /**
     * Get the DTO from the request.
     */
    public function getDto(): GetUserBookingsDTO
    {
        return GetUserBookingsDTO::from([
            'user_id' => $this->user()->id
        ]);
    }
}
