<?php
namespace Database\Factories;


use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory {
    protected $model = Restaurant::class;

    public function definition() {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'img_restaurant' => null,
            'average_price' => $this->faker->numberBetween(10, 50),
            'phone' => $this->faker->numerify('9########'),
            'opening_hours' => $this->faker->time(),
            'closing_hours' => $this->faker->time(),
            'manager_id_users' => \App\Models\User::where('id_rol', 2)->inRandomOrder()->first()->id_users ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
