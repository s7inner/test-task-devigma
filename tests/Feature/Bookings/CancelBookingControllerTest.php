<?php

namespace Tests\Feature\Bookings;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CancelBookingControllerTest extends TestCase
{
    private User $user;

    private User $otherUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();
    }

    /**
     * Test successful booking cancellation.
     */
    public function test_can_cancel_booking(): void
    {
        $booking = Booking::factory()
            ->for($this->user)
            ->booked()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->patchJson(route('bookings.cancel', ['id' => $booking->id]));

        $response->assertStatus(Response::HTTP_OK)
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

        $this->assertEquals(Booking::STATUS_CANCELLED, $response->json('data.status'));

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'user_id' => $this->user->id,
            'status' => Booking::STATUS_CANCELLED,
        ]);
    }

    /**
     * Test that users cannot cancel other users' bookings.
     */
    public function test_cannot_cancel_other_user_booking(): void
    {
        $otherUserBooking = Booking::factory()
            ->for($this->otherUser)
            ->booked()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->patchJson(route('bookings.cancel', ['id' => $otherUserBooking->id]));

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        // Verify booking status hasn't changed
        $this->assertDatabaseHas('bookings', [
            'id' => $otherUserBooking->id,
            'user_id' => $this->otherUser->id,
            'status' => Booking::STATUS_BOOKED,
        ]);
    }

    /**
     * Test that unauthenticated users cannot cancel bookings.
     */
    public function test_unauthenticated_user_cannot_cancel_booking(): void
    {
        $booking = Booking::factory()
            ->for($this->user)
            ->booked()
            ->create();

        $response = $this->patchJson(route('bookings.cancel', ['id' => $booking->id]));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test cancellation fails with invalid booking ID.
     */
    #[DataProvider('invalidBookingIdProvider')]
    public function test_cannot_cancel_booking_with_invalid_id(mixed $invalidId, int $expectedStatus): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->patchJson(route('bookings.cancel', ['id' => $invalidId]));

        $response->assertStatus($expectedStatus);
    }

    /**
     * Test that already cancelled bookings can be cancelled again (idempotent).
     */
    public function test_can_cancel_already_cancelled_booking(): void
    {
        $booking = Booking::factory()
            ->for($this->user)
            ->cancelled()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->patchJson(route('bookings.cancel', ['id' => $booking->id]));

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEquals(Booking::STATUS_CANCELLED, $response->json('data.status'));

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'user_id' => $this->user->id,
            'status' => Booking::STATUS_CANCELLED,
        ]);
    }

    /**
     * Test that non-existent booking returns 404.
     */
    public function test_cannot_cancel_non_existent_booking(): void
    {
        $nonExistentId = 99999;

        $response = $this->actingAs($this->user, 'sanctum')
            ->patchJson(route('bookings.cancel', ['id' => $nonExistentId]));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * Test that booking cancellation updates the updated_at timestamp.
     */
    public function test_cancellation_updates_timestamp(): void
    {
        $booking = Booking::factory()
            ->for($this->user)
            ->booked()
            ->create();

        $originalUpdatedAt = $booking->updated_at;

        // Wait a moment to ensure timestamp difference
        sleep(1);

        $response = $this->actingAs($this->user, 'sanctum')
            ->patchJson(route('bookings.cancel', ['id' => $booking->id]));

        $response->assertStatus(Response::HTTP_OK);

        $booking->refresh();
        $this->assertTrue($booking->updated_at->gt($originalUpdatedAt));
    }

    /**
     * Data provider for invalid booking ID scenarios.
     */
    public static function invalidBookingIdProvider(): array
    {
        return [
            'string ID' => ['abc', Response::HTTP_NOT_FOUND],
            'negative ID' => [-1, Response::HTTP_NOT_FOUND],
            'zero ID' => [0, Response::HTTP_NOT_FOUND],
            'float ID' => [1.5, Response::HTTP_NOT_FOUND],
        ];
    }
}
