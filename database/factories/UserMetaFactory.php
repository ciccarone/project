<?php

namespace Database\Factories;

use App\Models\UserMeta;
use App\Models\User;
use App\Models\Business;
use App\Models\Group;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMeta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'business_id' => Business::factory(),
            'group_id' => Group::factory(),
            'role_id' => Role::factory(), // Generate a valid role_id using the Role factory
            'approved' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
