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
    
    public function manager() {
        return $this->hasMany(User::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function reviews() {
        return $this->hasMany(Favorite::class);
    }

    public function foodImage() {
        return $this->hasMany(FoodImage::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class,'restaurant_tags','restaurants_id','tags_id');
    }

    public function zone() {
        return $this->belongsTo(Zone::class);
    }

}
