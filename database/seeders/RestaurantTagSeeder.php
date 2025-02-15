<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        $restaurante1 = Restaurant::where('name','Paco Meralgo')->first();
        $restaurante2 = Restaurant::where('name','Disfrutar')->first();

        $tag1 = Tag::where('name','Comida Rápida')->first();
        $tag2 = Tag::where('name','Café')->first();

        $tag3 = Tag::where('name','Alta Cocina')->first();
        $tag4 = Tag::where('name','Comida Casera')->first();

        $restaurante1->tags()->attach([$tag1->id, $tag2->id]);
        $restaurante2->tags()->attach([$tag3->id, $tag4->id]);

    }
}
