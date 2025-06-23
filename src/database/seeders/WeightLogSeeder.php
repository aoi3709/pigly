<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeightLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->where('email', 'test@example.com')->value('id');

        if ($userId) {
            
            for ($i = 0; $i < 7; $i++) {
                DB::table('weight_logs')->insert([
                    'user_id' => $userId,
                    'date' => Carbon::now()->subDays($i)->format('Y-m-d'),
                    'weight' => round(rand(500, 700) / 10, 1), 
                    'calories' => rand(1500, 2500), 
                    'exercise_time' => sprintf('%02d:00:00', rand(0, 1)),
                    'exercise_content' => 'ランダムな運動内容 ' . ($i + 1),
                    'created_at' => Carbon::now()->subDays($i),
                    'updated_at' => Carbon::now()->subDays($i),
                ]);
            }
        }
    }
}