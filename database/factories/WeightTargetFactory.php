<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Seeder側で上書きするので仮の値でOK
            'user_id' => 1,

            // 目標体重をランダム生成（例: 40.0〜70.0kg）
            'target_weight' => $this->faker->randomFloat(1, 40, 70),
        ];
    }
}
