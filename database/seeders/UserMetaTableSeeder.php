<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserMeta;
use App\Models\User;
use App\Models\Business;
use App\Models\Chamber;
use App\Models\Group;
use App\Models\Role;

class UserMetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are related entities to reference
        $user = User::factory()->create();
        $business = Business::factory()->create();
        $group = Group::factory()->create();
        $chamber = Chamber::factory()->create();

        UserMeta::create([
            'user_id' => $user->id,
            'business_id' => $business->id,
            'group_id' => $group->id,
            'chamber_id' => $chamber->id,
            'role_id' => $role->id,
            'approved' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
