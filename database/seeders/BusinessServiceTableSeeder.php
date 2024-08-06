<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\Service;

class BusinessServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are related entities to reference
        $business = Business::firstOrCreate([
            'name' => '3tone Digital',
            'address' => '123 Main St, Saratoga, NY',
            'website_url' => 'https://3tonedigital.com',
            'social_profiles' => json_encode([
                'twitter' => 'https://twitter.com/3toneDigital',
                'linkedin' => 'https://linkedin.com/company/3tone-digital',
            ]),
        ]);

        $service = Service::firstOrCreate([
            'name' => 'Web Development',
        ]);

        // Attach the service to the business
        $business->services()->attach($service->id);
    }
}
