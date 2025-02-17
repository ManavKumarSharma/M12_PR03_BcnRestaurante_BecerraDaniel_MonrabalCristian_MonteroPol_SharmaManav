<?php

namespace Database\Seeders;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();


        Tag::create([
            'name' => 'Vegetariano',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Vegano',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Sin Gluten',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Comida Rápida',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Alta Cocina',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Buffet',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Mariscos',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Carnes',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Sushi',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Postres',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Café',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Comida Casera',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Barbacoa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Mexicana',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Italiana',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'China',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Japonesa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Tailandesa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'India',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Mediterránea',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Francesa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Española',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Argentina',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Peruana',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Hamburguesas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Pizzas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Tacos',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Tapas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Healthy',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Tag::create([
            'name' => 'Orgánico',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

    }
}
