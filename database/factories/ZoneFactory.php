<?php
namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    protected $model = Zone::class;

    public function definition()
    {
        return [
            'id_zones' => $this->faker->randomNumber(5),
            'name_zone' => $this->faker->word(),
        ];
    }
}
