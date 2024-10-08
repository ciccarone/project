<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Chamber;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'chamber_id' => Chamber::factory(),
            'group_manager_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
