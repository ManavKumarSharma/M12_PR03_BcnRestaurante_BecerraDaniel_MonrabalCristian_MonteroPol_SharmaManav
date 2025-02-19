<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = ['users_id', 'restaurants_id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurants_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
}