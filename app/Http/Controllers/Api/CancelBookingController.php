<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CancelBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;

class CancelBookingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(BookingService $service, CancelBookingRequest $request): BookingResource
    {
        return new BookingResource(
            $service->cancelBooking($request->getDto())
        );
    }
}
