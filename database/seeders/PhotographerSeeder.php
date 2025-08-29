<?php

namespace Database\Seeders;

use App\Models\Photographers;
use Illuminate\Database\Seeder;
use App\Models\Photographer;
use App\Models\Booking;

class PhotographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure Faker helper is available
        for ($i = 0; $i < 10; $i++) {
            $photographer = Photographers::create([
                'name' => fake()->name(),
                'specialty' => fake()->randomElement(['Wedding', 'Portrait', 'Corporate', 'Event']),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'profile_pic' => null,
            ]);

            for ($j = 0; $j < rand(1, 3); $j++) {
                Booking::create([
                    'customer_name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'phone' => fake()->phoneNumber(),
                    'event_type' => fake()->randomElement(['Wedding', 'Birthday', 'Corporate', 'Event']),
                    'event_date' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
                    'special_requests' => fake()->sentence(),
                    'photographer_id' => $photographer->id,
                    'status' => fake()->randomElement(['pending','approved','rejected']),
                ]);
            }
        }
    }
}