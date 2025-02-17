<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Indica cuál es la clave primaria
    protected $primaryKey = 'id_user';

    // Campos asignables masivamente
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password_hash',
        'phone_number',
        'id_rol',
        'profile_image'
    ];

    // Ocultar estos campos en las respuestas JSON
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * Sobreescribe el método para obtener la contraseña
     * para que use la columna "password_hash".
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}