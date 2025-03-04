<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervention>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modelType = $this->faker->randomElement(['Hive', 'Apiary']);
        $modelClass = 'App\\Models\\' . $modelType;

        return [
            'user_id' => User::all()->random()->id,
            'model_type' => $modelType,
            'model_id' => $modelClass::all()->random()->id,
            'type' => $this->faker->word,
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'date' => $this->faker->date(),
            'observations' => $this->faker->sentences(rand(1, 3), true),
            'attachment_path' => $this->faker->imageUrl(),
        ];
    }
}
