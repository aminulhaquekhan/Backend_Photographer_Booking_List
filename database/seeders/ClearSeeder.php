<?php

namespace Database\Seeders;

use App\Models\Photographers;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class ClearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear all bookings first (to avoid foreign key issues)
        Booking::truncate();

        // Clear all photographers
        Photographers::truncate();
    }
}