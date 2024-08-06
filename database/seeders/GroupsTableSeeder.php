<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Chamber;
use App\Models\User;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are related entities to reference
        $chamber = Chamber::factory()->create();
        $user = User::factory()->create();

        Group::create([
            'name' => 'BRG4',
            'chamber_id' => $chamber->id,
            'group_manager_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
