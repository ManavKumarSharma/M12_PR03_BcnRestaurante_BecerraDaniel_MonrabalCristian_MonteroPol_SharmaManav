<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\User;
use App\Models\Zone;
use App\Models\Restaurant;
use App\Models\Tag;
use App\Models\FoodImage;
use App\Models\Review;
use App\Models\Favorite;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear algunos roles
        $roles = Rol::factory()->count(3)->create();

        // Crear usuarios (algunos serán managers)
        $users = User::factory()->count(20)->create();

        // Crear zonas
        $zones = Zone::factory()->count(5)->create();

        // Crear restaurantes asignando un manager y una zona aleatoriamente
        $restaurants = Restaurant::factory()->count(10)->create([
            'id_manager' => $users->random()->id_user,
            'id_zone'    => $zones->random()->id_zone,
        ]);

        // Crear tags
        $tags = Tag::factory()->count(10)->create();

        // Asignar tags a cada restaurante (relación many-to-many)
        foreach ($restaurants as $restaurant) {
            $restaurant->tags()->attach($tags->random(rand(1, 3))->pluck('id_tag')->toArray());
        }

        // Crear imágenes de comida para cada restaurante
        foreach ($restaurants as $restaurant) {
            FoodImage::factory()->count(3)->create(['id_restaurant' => $restaurant->id_restaurant]);
        }

        // Crear reviews para cada restaurante
        foreach ($restaurants as $restaurant) {
            Review::factory()->count(5)->create(['id_restaurant' => $restaurant->id_restaurant]);
        }

        // Crear favorites para algunos usuarios
        foreach ($users as $user) {
            Favorite::factory()->count(rand(0, 3))->create(['id_user' => $user->id_user]);
        }
    }
}
