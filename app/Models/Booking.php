<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'event_type',
        'event_date',
        'location',
        'special_requests',
        'photographer_id',
    ];

    public function photographer()
    {
        return $this->belongsTo(Photographers::class);
    }
}