<?php
namespace Database\Factories;


use App\Models\FoodImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodImageFactory extends Factory {
    protected $model = FoodImage::class;

    public function definition() {
        return [
            'restaurant_id_restaurants' => \App\Models\Restaurant::inRandomOrder()->first()->id_restaurants ?? 1,
            'image_url' => $this->faker->imageUrl(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
