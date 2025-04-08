<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'user_id' => 1,
            'status' => rand(0,1),
            'priority' => rand(1,4),
        ];
    }
}
