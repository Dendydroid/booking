<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 * @package App
 */
class Room extends Model
{
    protected $table = "rooms";

    protected $fillable = [
        "status",
        "number",
        "price",
        "client_occupied_id",
        "type",
        "stars",
    ];
}
