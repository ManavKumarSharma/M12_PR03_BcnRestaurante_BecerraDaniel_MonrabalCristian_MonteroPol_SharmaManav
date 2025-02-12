<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Tag;
use App\Models\RestaurantTag;
use App\Models\FoodImage;
use App\Models\Review;

class DatabaseSeeder extends Seeder {
    public function run() {
        // Crear roles
        Role::factory()->count(3)->create();

        // Crear usuarios (admin, manager, user)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'id_rol' => 1
        ]);
        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'id_rol' => 2
        ]);
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'id_rol' => 3
        ]);
        User::factory()->count(10)->create();

        // Crear restaurantes
        Restaurant::factory()->count(5)->create();

        // Crear tags
        Tag::factory()->count(5)->create();

        // Asignar tags a restaurantes
        RestaurantTag::factory()->count(10)->create();

        // Crear imágenes de comida
        FoodImage::factory()->count(10)->create();

        // Crear reviews
        Review::factory()->count(20)->create();
    }
}

