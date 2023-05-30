<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComputerFormatting>
 */
class ComputerFormattingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'computer_name'   => fake()->name,
            'computer_status' => fake()->randomElement(['new', 'used']),
            'computer_type'   => fake()->randomElement(['desktop', 'notebook']),
            'assignment_id'   => fake()->randomElement([1, 2, 3, 4, 5]),
            'situation'       => fake()->randomElement(['pending', 'completed']),
        ];
    }
}
