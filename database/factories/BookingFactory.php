<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'time_slot' => $this->faker->randomElement([
                '09:00:00', '10:00:00', '11:00:00', '12:00:00',
                '13:00:00', '14:00:00', '15:00:00', '16:00:00'
            ]),
            'status' => $this->faker->randomElement([Booking::STATUS_BOOKED, Booking::STATUS_CANCELLED]),
        ];
    }

    /**
     * Indicate that the booking is booked.
     */
    public function booked(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Booking::STATUS_BOOKED,
        ]);
    }

    /**
     * Indicate that the booking is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Booking::STATUS_CANCELLED,
        ]);
    }
}
