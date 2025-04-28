<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\LeadStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status_id' => $faker->numberBetween(1, LeadStatus::max('id')),
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
