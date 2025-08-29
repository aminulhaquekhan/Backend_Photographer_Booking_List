<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Photographers;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clear old data
        Booking::truncate();
        Photographers::truncate();
        User::truncate();

        // Create 1 admin user
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create 50 regular users
        User::factory(50)->create();

        // Create 10 photographers
        Photographers::factory(10)->create();

        // Create 1-3 bookings per photographer
        Photographers::all()->each(function ($photographer) {
            Booking::factory(rand(1, 3))->create([
                'photographer_id' => $photographer->id
            ]);
        });
    }
}