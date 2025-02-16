<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        Favorite::create([
            'users_id' => 1,
            'restaurants_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
