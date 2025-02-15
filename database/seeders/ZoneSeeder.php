<?php

namespace Database\Seeders;

use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        Zone::create([
            'name_zone' => 'La Florida',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Can Serra',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Pubilla Cases',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Esplugues de Llobregat',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Santa Eulália',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Collblanc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Sants Estació',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Marina',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Rambla Just Oliveres',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Zone::create([
            'name_zone' => 'Bellvitge',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
