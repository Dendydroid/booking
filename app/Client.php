<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App
 */
class Client extends Model
{
    protected $table = "clients";

    protected $fillable = [
        "is_black_listed",
        "name",
        "phone",
    ];
}
