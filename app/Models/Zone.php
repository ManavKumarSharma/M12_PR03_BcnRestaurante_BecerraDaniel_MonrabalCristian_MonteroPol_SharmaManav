<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';
    
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'zones_id');
    }
}
