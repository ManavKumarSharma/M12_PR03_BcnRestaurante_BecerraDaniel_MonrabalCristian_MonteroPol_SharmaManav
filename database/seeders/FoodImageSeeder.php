<?php

namespace Database\Seeders;

use App\Models\FoodImage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FoodImageSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Restaurante 1
        FoodImage::create([
            'restaurants_id' => 1,
            'image_url'      => 'img1_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 1,
            'image_url'      => 'img1_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 2
        FoodImage::create([
            'restaurants_id' => 2,
            'image_url'      => 'img2_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 2,
            'image_url'      => 'img2_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 3
        FoodImage::create([
            'restaurants_id' => 3,
            'image_url'      => 'img3_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 3,
            'image_url'      => 'img3_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 4
        FoodImage::create([
            'restaurants_id' => 4,
            'image_url'      => 'img4_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 4,
            'image_url'      => 'img4_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 5
        FoodImage::create([
            'restaurants_id' => 5,
            'image_url'      => 'img5_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 5,
            'image_url'      => 'img5_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 6
        FoodImage::create([
            'restaurants_id' => 6,
            'image_url'      => 'img6_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 6,
            'image_url'      => 'img6_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 7
        FoodImage::create([
            'restaurants_id' => 7,
            'image_url'      => 'img7_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 7,
            'image_url'      => 'img7_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 8
        FoodImage::create([
            'restaurants_id' => 8,
            'image_url'      => 'img8_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 8,
            'image_url'      => 'img8_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 9
        FoodImage::create([
            'restaurants_id' => 9,
            'image_url'      => 'img9_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 9,
            'image_url'      => 'img9_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 10
        FoodImage::create([
            'restaurants_id' => 10,
            'image_url'      => 'img10_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 10,
            'image_url'      => 'img10_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 11
        FoodImage::create([
            'restaurants_id' => 11,
            'image_url'      => 'img11_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 11,
            'image_url'      => 'img11_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 12
        FoodImage::create([
            'restaurants_id' => 12,
            'image_url'      => 'img12_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 12,
            'image_url'      => 'img12_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 13
        FoodImage::create([
            'restaurants_id' => 13,
            'image_url'      => 'img13_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 13,
            'image_url'      => 'img13_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 14
        FoodImage::create([
            'restaurants_id' => 14,
            'image_url'      => 'img14_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 14,
            'image_url'      => 'img14_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 15
        FoodImage::create([
            'restaurants_id' => 15,
            'image_url'      => 'img15_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 15,
            'image_url'      => 'img15_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 16
        FoodImage::create([
            'restaurants_id' => 16,
            'image_url'      => 'img16_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 16,
            'image_url'      => 'img16_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 17
        FoodImage::create([
            'restaurants_id' => 17,
            'image_url'      => 'img17_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 17,
            'image_url'      => 'img17_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 18
        FoodImage::create([
            'restaurants_id' => 18,
            'image_url'      => 'img18_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 18,
            'image_url'      => 'img18_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 19
        FoodImage::create([
            'restaurants_id' => 19,
            'image_url'      => 'img19_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 19,
            'image_url'      => 'img19_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 20
        FoodImage::create([
            'restaurants_id' => 20,
            'image_url'      => 'img20_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 20,
            'image_url'      => 'img20_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 21
        FoodImage::create([
            'restaurants_id' => 21,
            'image_url'      => 'img21_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 21,
            'image_url'      => 'img21_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 22
        FoodImage::create([
            'restaurants_id' => 22,
            'image_url'      => 'img22_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 22,
            'image_url'      => 'img22_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 23
        FoodImage::create([
            'restaurants_id' => 23,
            'image_url'      => 'img23_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 23,
            'image_url'      => 'img23_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 24
        FoodImage::create([
            'restaurants_id' => 24,
            'image_url'      => 'img24_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 24,
            'image_url'      => 'img24_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 25
        FoodImage::create([
            'restaurants_id' => 25,
            'image_url'      => 'img25_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 25,
            'image_url'      => 'img25_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 26
        FoodImage::create([
            'restaurants_id' => 26,
            'image_url'      => 'img26_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 26,
            'image_url'      => 'img26_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 27
        FoodImage::create([
            'restaurants_id' => 27,
            'image_url'      => 'img27_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 27,
            'image_url'      => 'img27_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 28
        FoodImage::create([
            'restaurants_id' => 28,
            'image_url'      => 'img28_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 28,
            'image_url'      => 'img28_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 29
        FoodImage::create([
            'restaurants_id' => 29,
            'image_url'      => 'img29_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 29,
            'image_url'      => 'img29_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        // Restaurante 30
        FoodImage::create([
            'restaurants_id' => 30,
            'image_url'      => 'img30_1.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        FoodImage::create([
            'restaurants_id' => 30,
            'image_url'      => 'img30_2.jpg',
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
    }
}
