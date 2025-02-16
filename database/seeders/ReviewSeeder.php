<?php

namespace Database\Seeders;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        Review::create([
            'users_id' => 1,
            'restaurants_id' => 2,
            'score' => 1,
            'comment' => "Mierdón de restaurante",
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Review::create([
            'users_id' => 2,
            'restaurants_id' => 3,
            'score' => 5,
            'comment' => "Sacadita",
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
