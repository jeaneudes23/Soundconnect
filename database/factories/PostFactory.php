<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'caption' =>fake()->sentence(2),
            'audio_file' => fake()->randomElement(['track1.wav','track2.wav','track3.wav']),
            'tags' => "music,test,app,music",
            'type' => fake()->randomElement(['instrumental', 'vocal']),
            'license' => fake()->randomElement(['basic', 'premium']),
            'bpm' => fake()->numberBetween(0, 100),
        ];
    }
}
