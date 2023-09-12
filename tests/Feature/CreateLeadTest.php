<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateLeadTest extends TestCase
{
    /**
     * @test
     * A basic test example.
     */
    public function createLead(): void
    {
        // TODO - Criar os demais casos de teste para validar corretamente as mensagens de erro
        // TODO - Criar os demais casos de teste para validar corretamente as mensagens de sucesso
        // TODO - Criar os demais casos de teste para validar corretamente o funcionamento destas rotas
        $faker = \Faker\Factory::create();

        $response = $this->post('api/leads', [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'experience_level' => $faker->randomElement([
                'beginner',
                'amatuer',
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
        ]);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertStatus(200);
    }
}
