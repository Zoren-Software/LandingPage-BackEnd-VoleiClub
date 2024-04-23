<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListLeadTest extends TestCase
{
    protected $login = true;

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


        $response->assertStatus(200);
    }

}
