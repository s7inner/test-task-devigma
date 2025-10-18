<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;

class CreateBookingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(BookingService $service, CreateBookingRequest $request): BookingResource
    {
        return new BookingResource(
            $service->createBooking($request->getDto())
        );
    }
}
