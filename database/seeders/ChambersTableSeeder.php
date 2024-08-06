<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chamber;
use App\Models\ApprovedChamber;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChambersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there is an approved chamber to reference
        $approvedChamber = ApprovedChamber::firstOrCreate([
            'name' => 'Southern Saratoga Chamber of Commerce',
            'random_code' => Str::random(6)
        ]);

        Chamber::create([
            'approved_chamber_id' => $approvedChamber->id,
            'name' => 'Southern Saratoga Chamber of Commerce',
            'street' => '58 Clifton Country Rd #102',
            'city' => 'Clifton Park',
            'state' => 'NY',
            'zip' => '12065',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
