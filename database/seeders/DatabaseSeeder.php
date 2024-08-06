<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ApprovedChamber;
use App\Models\Chamber;
use App\Models\Business;
use Illuminate\Database\Seeder;

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
        ]);

        // Create approved chambers
        ApprovedChamber::factory()->count(5)->create();

        // Create chambers
        Chamber::factory()->count(10)->create();

        // Create businesses
        Business::factory()->count(10)->create();

        // Optionally, you can still call other seeders if needed
        $this->call([
            RolesTableSeeder::class,
            GroupsTableSeeder::class,
            // Add other seeders here as needed
        ]);
    }
}
