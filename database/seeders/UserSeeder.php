<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        User::create([
            'name' => 'Manav',
            'last_name' => 'Sharma',
            'email' => 'manavsharma@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 2,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Pol Marc',
            'last_name' => 'Montero',
            'email' => 'polmarcmontero@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 1,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Christian',
            'last_name' => 'Monrabal',
            'email' => 'christianmonrabal@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 1,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Daniel',
            'last_name' => 'Becerra',
            'email' => 'danielbecerra@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 1,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Manager 1',
            'last_name' => 'Apellido 1',
            'email' => 'manager1@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Manager 2',
            'last_name' => 'Apellido 2',
            'email' => 'manager2@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Manager 3',
            'last_name' => 'Apellido 3',
            'email' => 'manager3@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Manager 4',
            'last_name' => 'Apellido 4',
            'email' => 'manager4@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
          
        User::create([
            'name' => 'Manager 5',
            'last_name' => 'Apellido 5',
            'email' => 'manager5@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Manager 6',
            'last_name' => 'Apellido 6',
            'email' => 'manager6@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Manager 7',
            'last_name' => 'Apellido 7',
            'email' => 'manager7@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Manager 8',
            'last_name' => 'Apellido 8',
            'email' => 'manager8@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Manager 9',
            'last_name' => 'Apellido 9',
            'email' => 'manager9@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Manager 10',
            'last_name' => 'Apellido 10',
            'email' => 'manager10@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777999',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Manager 11',
            'last_name' => 'Apellido 11',
            'email' => 'manager11@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777900',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 12',
            'last_name' => 'Apellido 12',
            'email' => 'manager12@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777901',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 13',
            'last_name' => 'Apellido 13',
            'email' => 'manager13@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777902',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 14',
            'last_name' => 'Apellido 14',
            'email' => 'manager14@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777903',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 15',
            'last_name' => 'Apellido 15',
            'email' => 'manager15@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777904',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 16',
            'last_name' => 'Apellido 16',
            'email' => 'manager16@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777905',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 17',
            'last_name' => 'Apellido 17',
            'email' => 'manager17@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777906',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 18',
            'last_name' => 'Apellido 18',
            'email' => 'manager18@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777907',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 19',
            'last_name' => 'Apellido 19',
            'email' => 'manager19@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777908',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 20',
            'last_name' => 'Apellido 20',
            'email' => 'manager20@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777909',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 21',
            'last_name' => 'Apellido 21',
            'email' => 'manager21@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777910',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 22',
            'last_name' => 'Apellido 22',
            'email' => 'manager22@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777911',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 23',
            'last_name' => 'Apellido 23',
            'email' => 'manager23@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777912',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 24',
            'last_name' => 'Apellido 24',
            'email' => 'manager24@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777913',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 25',
            'last_name' => 'Apellido 25',
            'email' => 'manager25@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777914',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 26',
            'last_name' => 'Apellido 26',
            'email' => 'manager26@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777915',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 27',
            'last_name' => 'Apellido 27',
            'email' => 'manager27@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777916',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 28',
            'last_name' => 'Apellido 28',
            'email' => 'manager28@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777917',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 29',
            'last_name' => 'Apellido 29',
            'email' => 'manager29@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777918',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'Manager 30',
            'last_name' => 'Apellido 30',
            'email' => 'manager30@gmail.com',
            'password' => bcrypt('qweQWE123'),
            'phone_number' => '666777919',
            'rol_id' => 3,
            'profile_image' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

    }
}
