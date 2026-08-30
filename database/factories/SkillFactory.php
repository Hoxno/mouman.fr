<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    protected $model = Skill::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->word().' '.fake()->word(),
            'level' => (string) fake()->numberBetween(1, 100),
            'description' => fake()->sentence(),
            'order' => (string) fake()->numberBetween(1, 50),
            'online' => '1',
        ];
    }

    /**
     * Compétence masquée du site public.
     */
    public function offline(): static
    {
        return $this->state(fn (array $attributes) => ['online' => '0']);
    }
}
