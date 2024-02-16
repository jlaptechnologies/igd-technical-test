<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberDetail>
 */
class MemberDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(array $attributes = []): array
    {
        return [
            'member_id' => $attributes['member_id'] ?? null,
            'email' => $attributes['email'] ?? $this->faker->email(),
            'dateJoined' => $attributes['dateJoined'] ?? $this->faker->dateTimeBetween('-28 months', '-24 months')
        ];
    }
}
