<?php

namespace Tests\Feature\Bookings;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CreateBookingControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * Test successful booking creation with valid data.
     */
    #[DataProvider('validBookingDataProvider')]
    public function test_can_create_booking_with_valid_data(array $bookingData): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('bookings.store'), $bookingData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'date',
                    'time_slot',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('bookings', [
            'user_id' => $this->user->id,
            'date' => $bookingData['date'],
            'time_slot' => $bookingData['time_slot'],
            'status' => Booking::STATUS_BOOKED,
        ]);
    }

    /**
     * Test booking creation fails with invalid data.
     */
    #[DataProvider('invalidBookingDataProvider')]
    public function test_cannot_create_booking_with_invalid_data(array $bookingData, array $expectedErrors): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('bookings.store'), $bookingData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors($expectedErrors);
    }

    /**
     * Test that unauthenticated users cannot create bookings.
     */
    public function test_unauthenticated_user_cannot_create_booking(): void
    {
        $bookingData = [
            'date' => now()->addDay()->format('Y-m-d'),
            'time_slot' => '10:00',
        ];

        $response = $this->postJson(route('bookings.store'), $bookingData);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test that users cannot create bookings for past dates.
     */
    public function test_cannot_create_booking_for_past_date(): void
    {
        $bookingData = [
            'date' => now()->subDay()->format('Y-m-d'),
            'time_slot' => '10:00',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('bookings.store'), $bookingData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['date']);
    }

    /**
     * Test that users cannot create bookings for today.
     */
    public function test_cannot_create_booking_for_today(): void
    {
        $bookingData = [
            'date' => now()->format('Y-m-d'),
            'time_slot' => '10:00',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson(route('bookings.store'), $bookingData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['date']);
    }

    /**
     * Data provider for valid booking scenarios.
     */
    public static function validBookingDataProvider(): array
    {
        return [
            'tomorrow morning' => [
                [
                    'date' => now()->addDay()->format('Y-m-d'),
                    'time_slot' => '09:00',
                ],
            ],
            'next week afternoon' => [
                [
                    'date' => now()->addWeek()->format('Y-m-d'),
                    'time_slot' => '14:00',
                ],
            ],
            'end of month' => [
                [
                    'date' => now()->addMonth()->format('Y-m-d'),
                    'time_slot' => '16:00',
                ],
            ],
        ];
    }

    /**
     * Data provider for invalid booking scenarios.
     */
    public static function invalidBookingDataProvider(): array
    {
        return [
            'missing date' => [
                [
                    'time_slot' => '10:00',
                ],
                ['date'],
            ],
            'missing time_slot' => [
                [
                    'date' => now()->addDay()->format('Y-m-d'),
                ],
                ['time_slot'],
            ],
            'invalid date format' => [
                [
                    'date' => 'invalid-date',
                    'time_slot' => '10:00',
                ],
                ['date'],
            ],
            'invalid time_slot' => [
                [
                    'date' => now()->addDay()->format('Y-m-d'),
                    'time_slot' => '25:00',
                ],
                ['time_slot'],
            ],
            'non-existent time_slot' => [
                [
                    'date' => now()->addDay()->format('Y-m-d'),
                    'time_slot' => '10:30',
                ],
                ['time_slot'],
            ],
            'empty data' => [
                [],
                ['date', 'time_slot'],
            ],
        ];
    }
}
