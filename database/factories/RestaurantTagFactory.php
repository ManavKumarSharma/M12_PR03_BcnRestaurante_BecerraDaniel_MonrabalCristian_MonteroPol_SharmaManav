<?php
namespace Database\Factories;


use App\Models\RestaurantTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


class RestaurantTagFactory extends Factory {
    protected $model = RestaurantTag::class;

    public function definition() {
        return [
            'restaurant_id_restaurants' => \App\Models\Restaurant::inRandomOrder()->first()->id_restaurants ?? 1,
            'tag_id_tags' => \App\Models\Tag::inRandomOrder()->first()->id_tags ?? 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
