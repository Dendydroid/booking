<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 * @package App
 */
class Booking extends Model
{
    protected $table = "bookings";

    protected $fillable = [
        "price",
        "room_number",
        "nights",
        "active",
        "created_at",
    ];
}
