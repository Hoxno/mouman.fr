<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<School>
 */
class SchoolFactory extends Factory
{
    protected $model = School::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'school' => fake()->company(),
            'city' => fake()->city(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'description' => fake()->sentence(),
            'online' => '1',
        ];
    }

    /**
     * Formation masquée du site public.
     */
    public function offline(): static
    {
        return $this->state(fn (array $attributes) => ['online' => '0']);
    }
}
