<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameScore>
 */
class GameScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(array $attributes = []): array
    {
        return [
            'playerScore' => $attributes['playerScore'] ?? \mt_rand(284, 589),
        ];
    }
}
