<?php

namespace Tests\Feature\Bookings;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetUserBookingsControllerTest extends TestCase
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
     * Test successful retrieval of user bookings.
     */
    public function test_can_get_user_bookings(): void
    {
        Booking::factory()
            ->count(3)
            ->for($this->user)
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('bookings.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'date',
                        'time_slot',
                        'status',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);

        $this->assertCount(3, $response->json('data'));
    }

    /**
     * Test that users only see their own bookings.
     */
    public function test_user_can_only_see_own_bookings(): void
    {
        // Create bookings for both users
        Booking::factory()
            ->count(2)
            ->for($this->user)
            ->create();

        Booking::factory()
            ->count(3)
            ->for($this->otherUser)
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('bookings.index'));

        $response->assertStatus(Response::HTTP_OK);

        $responseData = $response->json('data');
        $this->assertCount(2, $responseData);

        // Verify all returned bookings belong to the authenticated user
        foreach ($responseData as $booking) {
            $this->assertDatabaseHas('bookings', [
                'id' => $booking['id'],
                'user_id' => $this->user->id,
            ]);
        }
    }

    /**
     * Test empty bookings list for user with no bookings.
     */
    public function test_returns_empty_list_when_user_has_no_bookings(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('bookings.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(0, 'data');
    }

    /**
     * Test that unauthenticated users cannot get bookings.
     */
    public function test_unauthenticated_user_cannot_get_bookings(): void
    {
        $response = $this->getJson(route('bookings.index'));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test that bookings include both booked and cancelled statuses.
     */
    public function test_returns_bookings_with_different_statuses(): void
    {
        Booking::factory()
            ->for($this->user)
            ->booked()
            ->create();

        Booking::factory()
            ->for($this->user)
            ->cancelled()
            ->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson(route('bookings.index'));

        $response->assertStatus(Response::HTTP_OK);

        $responseData = $response->json('data');
        $this->assertCount(2, $responseData);

        $statuses = array_column($responseData, 'status');
        $this->assertContains(Booking::STATUS_BOOKED, $statuses);
        $this->assertContains(Booking::STATUS_CANCELLED, $statuses);
    }
}
