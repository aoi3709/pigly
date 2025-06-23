<?php

namespace Database\Factories;

use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class WeightTargetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WeightLog::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hours = $this->faker->numberBetween(0, 2);
        $minutes = $this->faker->numberBetween(0, 59);
        
        return [
            'weight' => $this->faker->randomFloat(1, 50, 80),
            'calories' => $this->faker->numberBetween(1500, 3000),
            'exercise_time' => Carbon::createFromTime($hours, $minutes, 0)->format('H:i:s'),
            'exercise_content' => $this->faker->sentence(rand(5, 15)),
        ];
    }
}
