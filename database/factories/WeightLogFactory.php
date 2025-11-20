<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeightLog>
 */
class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1, // 仮のユーザーに紐付け
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 60),
            'calories' => $this->faker->numberBetween(1000, 2500),
            'exercise_time' => $this->faker->time('H:i'),
            'exercise_content' => $this->faker->sentence(),
        ];
    }
}
