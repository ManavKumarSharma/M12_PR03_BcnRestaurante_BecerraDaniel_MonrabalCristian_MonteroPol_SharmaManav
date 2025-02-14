<?php

namespace Database\Seeders;

use App\Models\FoodImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodImage::create([
            'nombre' => 'Superman',
            'editorial_id' => 1, // ID de DC
        ]);
    }
}
