<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Requests\Api\GetUserBookingsRequest;
use App\Services\BookingService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetUserBookingsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(BookingService $service, GetUserBookingsRequest $request): AnonymousResourceCollection
    {
        return BookingResource::collection(
            $service->getUserBookings($request->getDto())
        );
    }
}
