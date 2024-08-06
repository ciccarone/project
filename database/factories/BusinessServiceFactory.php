<?php

namespace Database\Factories;

use App\Models\BusinessService;
use App\Models\Business;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusinessService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_id' => Business::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
