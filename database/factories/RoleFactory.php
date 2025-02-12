<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory {
    protected $model = Role::class;

    public function definition() {
        return [
            'name' => $this->faker->unique()->randomElement(['Admin', 'Manager', 'User']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

