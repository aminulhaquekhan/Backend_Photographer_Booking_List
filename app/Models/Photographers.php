<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photographers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'email',
        'phone',
        'profile_pic',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}