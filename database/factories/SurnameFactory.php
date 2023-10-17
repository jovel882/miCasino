<?php

namespace Database\Factories;

use App\Models\Surname;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surname>
 */
class SurnameFactory extends Factory
{
    protected $model = Surname::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'surname' => $this->faker->unique()->lastName,
        ];
    }
}
