<?php
namespace Database\Factories;


use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory {
    protected $model = Review::class;

    public function definition() {
        return [
            'user_id_users' => \App\Models\User::inRandomOrder()->first()->id_users ?? 1,
            'restaurant_id_restaurants' => \App\Models\Restaurant::inRandomOrder()->first()->id_restaurants ?? 1,
            'score' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
