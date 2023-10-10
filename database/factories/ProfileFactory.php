<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
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
            'activities' => fake()->randomElement(['singer', 'producer','instrumentalist','no preference']),
            'profile_image' => "users/images/profile.jpg" ,
            'bio' => fake()->sentence(6),
            
        ];
    }
}
