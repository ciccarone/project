<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'website_url' => $this->faker->url,
            'social_profiles' => json_encode([
                'twitter' => $this->faker->url,
                'linkedin' => $this->faker->url,
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
