<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\For_;

class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory;

    protected $table = 'restaurants';

    protected $primaryKey = 'id_restaurant';

    
    public function manager() {
        return $this->hasMany(User::class, 'id_manager', 'id_user');
    }

    public function favorites() {
        return $this->hasMany(Favorite::class, 'id_favorites');
    }

    public function reviews() {
        return $this->hasMany(Favorite::class, 'id_manager', 'id_user');
    }

    public function foodImage() {
        return $this->hasMany(FoodImage::class, 'id_manager');
    }

}
