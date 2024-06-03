<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lead;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadInteraction>
 */
class LeadInteractionFactory extends Factory
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
            'lead_id' => Lead::factory(),
            'user_id' => User::factory(),
            'status' => $faker->randomElement([
                'new',
                'contacted',
                'converted',
                'unqualified',
                'qualified',
                'bad_email',
                'spam',
                'test',
                'trial_period',
                'active_customer',
            ]),
            'message' => $faker->text(),
            'notes' => $faker->text(),
        ];
    }

    public function userId(int $userId): self
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'user_id' => $userId,
            ];
        });
    }
}
