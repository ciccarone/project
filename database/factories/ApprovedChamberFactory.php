<?php

namespace Database\Factories;

use App\Models\ApprovedChamber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApprovedChamberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApprovedChamber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company . ' Chamber of Commerce',
            'random_code' => Str::random(6),
        ];
    }
}
