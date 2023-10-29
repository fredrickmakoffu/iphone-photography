<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Achievement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = ['comment', 'lesson'];
        return [
            // rand between comment and lesson
            'type' => $type[rand(0, 1)],
            'description' => $this->faker->text(),
            'points' => $this->faker->numberBetween(1, 10),
        ];
    }
}
