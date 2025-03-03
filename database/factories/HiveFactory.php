<?php

namespace Database\Factories;

use App\Models\Apiary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hive>
 */
class HiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'apiary_id' => Apiary::all()->random()->id,
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'installation_date' => $this->faker->date(),
        ];
    }
}
