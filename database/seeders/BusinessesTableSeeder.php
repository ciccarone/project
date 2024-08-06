<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'name' => '3tone Digital',
            'address' => '123 Main St, Saratoga, NY',
            'website_url' => 'https://3tonedigital.com',
            'social_profiles' => json_encode([
                'twitter' => 'https://twitter.com/3toneDigital',
                'linkedin' => 'https://linkedin.com/company/3tone-digital',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
