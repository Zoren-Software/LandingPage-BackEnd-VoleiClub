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
     * @dataProvider editLeadsInteractionsProviderSuccess
     * @dataProvider editLeadsInteractionsProviderError
     *
     * A basic test example.
     */
    public function editLeadsInteractions(array $parameters, array $data, $expectedStatusCode, string $expectedMessage): void
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

        if($data['status'] === false) {
            unset($data['status']);
        }

        if($data['message'] === false) {
            unset($data['message']);
        }

        if($data['notes'] === false) {
            unset($data['notes']);
        }

        $response = $this->rest()->putJson("api/leads/$leadId/interactions/$interactionId", $data);

        if ($response->getStatusCode() == 200) {
            $response
                ->assertJsonStructure([
                    'message',
                    'status',
                    'interaction'
                ])
                ->assertStatus(200);

            return;
        } elseif($response->getStatusCode() == 404) {

            $modelIdError = $parameters['leadId'] === false ? $leadId : $interactionId;

            $response
                ->assertJsonStructure([
                    'message',
                ])
                ->assertJson([
                    'message' => $expectedMessage . $modelIdError,
                ])
                ->assertStatus(404);

            return;
        } else {
            $response
                ->assertJsonStructure([
                    'message',
                ])
                ->assertJson([
                    'message' => trans($expectedMessage),
                ])
                ->assertStatus($expectedStatusCode);

            return;
        }
    }

    public static function editLeadsInteractionsProviderSuccess()
    {
        return [
            'edit lead interactions, parameters corrects, success' => [
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
                'expectedMessage' => 'success',
            ],
        ];
    }

    public static function editLeadsInteractionsProviderError()
    {
        return [
            'edit lead interactions, without leadId, error' => [
                'parameters' => [
                    'leadId' => false,
                    'interactionId' => true,
                ],
                'data' => [
                    'status' => 'new',
                    'message' => 'Message test',
                    'notes' => 'Notes test',
                ],
                'expectedStatusCode' => 404,
                'expectedMessage' => 'No query results for model [App\\Models\\Lead] ',
            ],
            'edit lead interactions, without interactionId, error' => [
                'parameters' => [
                    'leadId' => true,
                    'interactionId' => false,
                ],
                'data' => [
                    'status' => 'new',
                    'message' => 'Message test',
                    'notes' => 'Notes test',
                ],
                'expectedStatusCode' => 404,
                'expectedMessage' => 'No query results for model [App\\Models\\LeadInteraction] ',
            ],
            'edit lead interactions, without status, error' => [
                'parameters' => [
                    'leadId' => true,
                    'interactionId' => true,
                ],
                'data' => [
                    'status' => false,
                    'message' => 'Message test',
                    'notes' => 'Notes test',
                ],
                'expectedStatusCode' => 422,
                'expectedMessage' => 'Leads.status_required'
            ],
            'edit lead interactions, without message_required, error' => [
                'parameters' => [
                    'leadId' => true,
                    'interactionId' => true,
                ],
                'data' => [
                    'status' => 'new',
                    'message' => false,
                    'notes' => 'Notes test',
                ],
                'expectedStatusCode' => 422,
                'expectedMessage' => 'Leads.message_required'
            ],
            'edit lead interactions, without message_string, error' => [
                'parameters' => [
                    'leadId' => true,
                    'interactionId' => true,
                ],
                'data' => [
                    'status' => 'new',
                    'message' => 123,
                    'notes' => 'Notes test',
                ],
                'expectedStatusCode' => 422,
                'expectedMessage' => 'Leads.message.string'
            ],
            'edit lead interactions, without notes_required, error' => [
                'parameters' => [
                    'leadId' => true,
                    'interactionId' => true,
                ],
                'data' => [
                    'status' => 'new',
                    'message' => 'Message test',
                    'notes' => false
                ],
                'expectedStatusCode' => 422,
                'expectedMessage' => 'Leads.notes_required'
            ],
            'edit lead interactions, without notes_string, error' => [
                'parameters' => [
                    'leadId' => true,
                    'interactionId' => true,
                ],
                'data' => [
                    'status' => 'new',
                    'message' => 'Message test',
                    'notes' => false
                ],
                'expectedStatusCode' => 422,
                'expectedMessage' => 'Leads.notes.string'
            ],
        ];
    }
}
