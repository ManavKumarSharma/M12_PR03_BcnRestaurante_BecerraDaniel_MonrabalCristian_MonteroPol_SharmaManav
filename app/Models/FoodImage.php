<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodImage extends Model
{
    /** @use HasFactory<\Database\Factories\FoodImageFactory> */
    use HasFactory;

    protected $table = 'food_images';

    protected $primaryKey = 'id_food_image';

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }

}
