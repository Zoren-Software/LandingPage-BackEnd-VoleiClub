<?php

namespace Tests\Feature;

use Tests\TestCase;

class ListLeadInteractionsTest extends TestCase
{
    protected $login = true;

    private array $dataStructure = [
        'current_page',
        'data' => [
            '*' => [
                'id',
                'lead_id',
                'status_id',
                'message',
                'notes',
                'user_id',
                'created_at',
                'updated_at',
                'user' => [
                    'id',
                    'github_id',
                    'auth_type',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
                'status' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ],
        ],
        'first_page_url',
        'from',
        'last_page',
        'last_page_url',
        'links' => [
            '*' => [
                'url',
                'label',
                'active',
            ],
        ],
        'next_page_url',
        'path',
        'per_page',
        'prev_page_url',
        'to',
        'total',
    ];

    /**
     * @test
     *
     * @group create-lead
     *
     * @dataProvider listarLeadsProvider
     */
    public function listLeadsInteractions($perPage, $page, int $perPageEsperado, int $pageEsperado): void
    {
        $lead = \App\Models\Lead::factory()
            ->has(
                \App\Models\LeadInteraction::factory()
                    ->userId($this->user->id)
                    ->count(5),
                'interactions'
            )
            ->create();

        $perPageGet = $perPage !== null ? '&per_page=' . $perPage : '';
        $pageGet = $page !== null ? '&page=' . $page : '';

        $response = $this->rest()->getJson("api/leads/{$lead->id}/interactions?$perPageGet$pageGet");

        $response->assertStatus(200);
        $response->assertJsonStructure($this->dataStructure);

        $this->assertEquals($perPageEsperado, $response['per_page']);
        $this->assertEquals($pageEsperado, $response['current_page']);
    }

    public static function listarLeadsProvider(): array
    {
        return [
            'listar interações lead, valores padrão, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1,
            ],
            'listar interações lead, setando valores por página, sucesso' => [
                'perPage' => 10,
                'page' => 2,
                'perPageEsperado' => 10,
                'pageEsperado' => 2,
            ],
        ];
    }
}
