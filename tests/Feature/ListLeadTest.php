<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListLeadTest extends TestCase
{
    protected $login = true;

    private $dataStructure = [
        'current_page',
        'data' => [
            '*' => [
                'id',
                'tenant_id',
                'status_id',
                'name',
                'email',
                'email_verified_at',
                'unsubscribed_at',
                'experience_level',
                'message',
                'created_at',
                'updated_at',
                'deleted_at',
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
     *
     * A basic test example.
     */
    public function listLeads($perPage, $page, int $perPageEsperado, int $pageEsperado): void
    {
        \App\Models\Lead::factory()->create();

        $perPageGet = $perPage != null ? '&per_page=' . $perPage : '';
        $pageGet = $page != null ? '&page=' . $page : '';

        $response = $this->rest()->getJson("api/leads?$perPageGet" . "$pageGet");

        $response->assertStatus(200);

        $response->assertJsonStructure($this->dataStructure);

        $this->assertEquals($perPageEsperado, $response['per_page']);
        $this->assertEquals($pageEsperado, $response['current_page']);
    }

    public static function listarLeadsProvider()
    {
        return [
            'listar leads, setando valores por página, sucesso' => [
                'perPage' => 10,
                'page' => 2,
                'perPageEsperado' => 10,
                'pageEsperado' => 2,
            ],
            'listar leads, valores padrão, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1,
            ],
        ];
    }
}
