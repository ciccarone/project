<?php

namespace Database\Factories;

use App\Models\Chamber;
use App\Models\ApprovedChamber;
use Illuminate\Database\Eloquent\Factories\Factory;


class ChamberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chamber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'approved_chamber_id' => ApprovedChamber::factory(),
            'name' => $this->faker->company . ' Chamber of Commerce',
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip' => $this->faker->postcode,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
