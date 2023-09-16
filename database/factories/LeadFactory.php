<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'experience_level' => $faker->randomElement([
                'beginner',
                'amateur',
                'student',
                'college',
                'semi-professional',
                'professional',
                'intermediate',
                'coach',
                'instructor',
                'other',
            ]),
            'message' => $faker->text(),
        ];
    }
}
