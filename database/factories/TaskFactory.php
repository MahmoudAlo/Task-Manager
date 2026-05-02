<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;



class TaskFactory extends Factory
{
 
    public function definition(): array
    {
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'title'=> fake()->sentence,
            'describion'=>fake()->paragraph,
            'priority'=>fake()->randomElement(['high','medium','low'])
        ];
    }
}
