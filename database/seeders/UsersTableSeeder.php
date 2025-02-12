<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password_hash' => Hash::make('password'),
                'id_rol' => 1,
                'profile_image' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password_hash' => Hash::make('password'),
                'id_rol' => 2,
                'profile_image' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password_hash' => Hash::make('password'),
                'id_rol' => 3,
                'profile_image' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

