<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyLeadInteractionsTest extends TestCase
{
    protected $login = true;

    /**
     * @test
     *
     * @group delete-lead-interaction
     *
     * A basic test example.
     */
    public function destroyLeadsInteractions(): void
    {
        $lead = \App\Models\Lead::factory()
            ->has(
                \App\Models\LeadInteraction::factory()
                    ->userId($this->user->id)
                    ->count(5), 
                'interactions'
            )
            ->create();

        $interaction = $lead->interactions->first();

        $this->rest()->deleteJson("api/leads/$lead->id/interactions/$interaction->id")
            ->assertJsonStructure([
                'message',
                'status'
            ])
            ->assertStatus(200);
    }
}
