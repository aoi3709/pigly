<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeightTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->where('email', 'test@example.com')->value('id');

        if ($userId && !DB::table('weight_targets')->where('user_id', $userId)->exists()) {
            DB::table('weight_targets')->insert([
                'user_id' => $userId,
                'target_weight' => 55.0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}