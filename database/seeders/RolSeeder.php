<?php

namespace Database\Seeders;

use App\Models\Rol;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        Rol::create([
            'name' => 'client',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Rol::create([
            'name' => 'administrator',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Rol::create([
            'name' => 'manager',
            'created_at' => $now,
            'updated_at' => $now,
        ]);   
    }
}
