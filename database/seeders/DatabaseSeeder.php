<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ApprovedChamber;
use App\Models\Chamber;
use App\Models\Business;
use App\Models\UserMeta;
use App\Models\Service;
use App\Models\Group;
use App\Models\Role;
use App\Models\BusinessService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Eloquent\Factories\Factory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Tony Ciccarone',
            'email' => 'tony@3tonedigital.com',
            'password' => Hash::make('G0dmoney')
        ]);

        Business::factory()->create([
            'name' => '3tone Digital',
            'address' => '800 Route 146, Suite 320',
            'website_url' => 'https://3tonedigital.com',
            'social_profiles' => json_encode([
                'twitter' => 'https://x.com/3tonedigital',
                'linkedin' => 'https://linkedin.com/in/ciccarone',
                'facebook' => 'https://facebook.com/yourprofile',
                'instagram' => 'https://instagram.com/yourprofile',
                'youtube' => 'https://youtube.com/yourchannel',
                'tiktok' => 'https://tiktok.com/@yourprofile',
                'github' => 'https://github.com/yourusername',
            ]),
        ]);

        Chamber::factory()->create([
            'name' => 'Southern Saratoga County Chamber of Commerce',
            'street' => '58 Clifton Country Rd #102',
            'city' => 'Clifton Park',
            'state' => 'NY',
            'zip' => '12065',
            'user_id' => 1,
        ]);

        Group::factory()->create([
            'name' => 'BRG4',
            'chamber_id' => 1,
            'group_manager_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        UserMeta::factory()->create([
            'user_id' => 1,
            'business_id' => 1,
            'chamber_id' => 1,
            'group_id' => Group::factory(),
            'role_id' => 1, // Generate a valid role_id using the Role factory
            'approved' => 1,
        ]);

        // Create approved chambers
        ApprovedChamber::factory()->count(5)->create();

        // Create chambers
        Chamber::factory()->count(10)->create();

        // Create businesses
        Business::factory()->count(10)->create();

        // Create usermeta
        UserMeta::factory()->count(10)->create();

        // Create services
        Service::factory()->count(10)->create();

        // Create business / service
        BusinessService::factory()->count(10)->create();

        // Optionally, you can still call other seeders if needed
        $this->call([
            GroupsTableSeeder::class,
            RolesTableSeeder::class,
        ]);

    }
}
