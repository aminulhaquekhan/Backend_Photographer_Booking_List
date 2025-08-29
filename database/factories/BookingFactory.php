<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\Photographers;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'event_type' => $this->faker->word(),
            'event_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'special_requests' => $this->faker->sentence(),
            'photographer_id' => Photographers::factory(), // automatically links to a photographer
        ];
    }
}