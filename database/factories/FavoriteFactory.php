<?php
namespace Database\Factories;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        return [
            'id_favorites' => $this->faker->randomNumber(5),
            'user_id_users' => User::inRandomOrder()->first()->id_users,
            'restaurant_id_restaurants' => Restaurant::inRandomOrder()->first()->id_restaurants,
        ];
    }
}
