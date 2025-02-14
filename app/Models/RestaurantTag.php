<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTag extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantTagFactory> */
    use HasFactory;

    protected $table = 'restaurant_tags';

    protected $primaryKey = 'id_restaurant_tags';
}
