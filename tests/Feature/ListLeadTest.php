<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListLeadTest extends TestCase
{
    /**
     * @test
     *
     * @group create-lead
     *
     * A basic test example.
     */
    public function listLeads(): void
    {
        \App\Models\Lead::factory()->create();

        $data = [];

        $response = $this->rest()->get('api/leads', $data);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'status',
                    'experience_level',
                    'message',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);

        $response->assertStatus(200);
    }

}
