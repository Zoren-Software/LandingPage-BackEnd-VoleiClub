<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Lead;
use App\Models\LeadInteraction;
use Tests\TestCase;

class EditLeadInteractionsTest extends TestCase
{
    protected $login = true;

    /**
     * @test
     *
     * @group edit-lead-interaction
     *
     * @dataProvider editLeadsInteractionsProvider
     *
     * A basic test example.
     */
    public function editLeadsInteractions(array $parameters, array $data, int $expectedStatusCode): void
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

        $leadId = $lead->id;
        $interactionId = $interaction->id;

        if ($parameters['leadId'] === false) {
            // NOTE - buscar ultimo lead +1
            $leadId = Lead::orderBy('id', 'desc')->first()->id + 1;
        }
        if ($parameters['interactionId'] === false) {
            // NOTE - buscar ultimo interaction +1
            $interactionId = LeadInteraction::orderBy('id', 'desc')->first()->id + 1;
        }

        $response = $this->rest()->put("api/leads/$leadId/interactions/$interactionId", $data);

        dd($response->json());
        dd('ola');

        if ($expectedStatusCode === $response->getStatusCode()) {
            $response
                ->assertJsonStructure([
                    'message',
                    'status',
                ])
                ->assertStatus(200);

            return;
        } else {

            $modelError = $parameters['leadId'] === false ? 'Lead' : 'LeadInteraction';
            $modelIdError = $parameters['leadId'] === false ? $leadId : $interactionId;

            $response
                ->assertJsonStructure([
                    'message',
                ])
                ->assertJson([
                    'message' => 'No query results for model [App\\Models\\' . $modelError . '] ' . $modelIdError,
                ])
                ->assertStatus(404);

            return;
        }
    }

    public static function editLeadsInteractionsProvider()
    {
        return [
            'destroy lead interactions, parameters corrects, success' => [
                'parameters' => [
                    'leadId' => true,
                    'interactionId' => true,
                ],
                'data' => [
                    'status' => 'new',
                    'message' => 'Message test',
                    'notes' => 'Notes test',
                ],
                'expectedStatusCode' => 200,
            ],
            // 'destroy lead interactions, without leadId, error' => [
            //     'data' => [
            //         'leadId' => false,
            //         'interactionId' => true,
            //     ],
            //     'expectedStatusCode' => 'error'
            // ],
            // 'destroy lead interactions, without interactionId, error' => [
            //     'data' => [
            //         'leadId' => true,
            //         'interactionId' => false,
            //     ],
            //     'expectedStatusCode' => 'error'
            // ]
        ];
    }
}
