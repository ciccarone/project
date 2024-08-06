<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApprovedChamber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApprovedChambersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApprovedChamber::create([
            'name' => 'Southern Saratoga Chamber of Commerce',
            'random_code' => Str::random(6),
        ]);
    }
}
