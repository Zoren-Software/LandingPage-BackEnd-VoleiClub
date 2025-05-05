<?php

namespace Tests\Feature;

use App\Models\Lead;
use Tests\TestCase;

class FrontVersionTest extends TestCase
{
    protected $login = false;

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function unsubscribeLeadSendEmail(): void
    {
        $lead = Lead::factory()->create();

        $response = $this->rest()
            ->getJson('/');

        $response->assertStatus(200);

    }
}
