<?php

namespace Database\Seeders;

use App\Models\FoodImage;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        FoodImage::create([
            'restaurants_id' => 1,
            'image_url' => "foto_comida.png",
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
