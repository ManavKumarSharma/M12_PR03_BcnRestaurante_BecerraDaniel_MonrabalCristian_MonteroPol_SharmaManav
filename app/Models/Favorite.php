<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $primaryKey = 'id_favorites';

    protected $fillable = [
        'user_id_users', 'restaurant_id_restaurants',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_users');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id_restaurants');
    }
}
