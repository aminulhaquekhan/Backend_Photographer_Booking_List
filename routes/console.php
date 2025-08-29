<?php

use Illuminate\Support\Facades\Artisan;
use App\Models\Booking;

Artisan::command('booking:summary', function () {
    $totalBookings = Booking::count();
    $pendingBookings = Booking::where('status', 'pending')->count();
    
    $this->info("📸 Photographer Booking Summary 📸");
    $this->line("Total Bookings: $totalBookings");
    $this->line("Pending Bookings: $pendingBookings");
})->purpose('Display a summary of all bookings');