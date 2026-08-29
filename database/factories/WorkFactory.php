<?php

namespace Database\Factories;

use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    protected $model = Work::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'company' => fake()->company(),
            'city' => fake()->city(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'description' => fake()->sentence(),
            'online' => '1',
        ];
    }

    /**
     * Expérience masquée du site public.
     */
    public function offline(): static
    {
        return $this->state(fn (array $attributes) => ['online' => '0']);
    }
}
