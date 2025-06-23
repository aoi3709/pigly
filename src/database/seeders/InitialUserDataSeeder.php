<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;
use Faker\Generator as Faker;

class InitialUserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker::class);

        // 1. テストユーザーを作成
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);



        // 3. そのユーザーに紐づく体重ログを35件作成
        for ($i = 0; $i < 35; $i++) {
            $hours = $faker->numberBetween(0, 2);
            $minutes = $faker->numberBetween(0, 59);

            $logAttributes = [
                'user_id' => $user->id,
                'date' => Carbon::now()->subDays($i)->format('Y-m-d'),
                'weight' => $faker->randomFloat(1, 50, 80),
                'calories' => $faker->numberBetween(1500, 3000),
                'exercise_time' => Carbon::createFromTime($hours, $minutes, 0)->format('H:i:s'),
                'exercise_content' => $faker->sentence(rand(5, 15)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
            ];

            
            DB::table('weight_logs')->insert($logAttributes); 
        }
    }
}