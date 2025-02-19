<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = ['users_id', 'restaurants_id', 'score', 'comment'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurants_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
}