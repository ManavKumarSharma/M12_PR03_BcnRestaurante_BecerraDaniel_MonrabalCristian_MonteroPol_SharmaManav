<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory {
    protected $model = User::class;

    public function definition() {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password_hash' => Hash::make('password'),
            'id_rol' => \App\Models\Rol::inRandomOrder()->first()->id_rol ?? 1,
            'profile_image' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
            
        ];
    }
}
