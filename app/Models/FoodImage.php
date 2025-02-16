<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodImage extends Model
{
    /** @use HasFactory<\Database\Factories\FoodImageFactory> */
    use HasFactory;

    protected $table = 'food_images';

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
