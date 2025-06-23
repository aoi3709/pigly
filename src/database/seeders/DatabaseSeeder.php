<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\InitialUserDataSeeder;
use Database\Seeders\WeightLogSeeder; 
use Database\Seeders\WeightTargetSeeder; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InitialUserDataSeeder::class,
            WeightLogSeeder::class,
            WeightTargetSeeder::class, 
        ]);
    }
}
