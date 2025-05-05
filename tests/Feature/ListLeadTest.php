<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Lead;
use App\Models\LeadInteraction;
use Illuminate\Support\Facades\DB;
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

    public function setUp(): void
    {
        parent::setUp();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        LeadInteraction::truncate();
        Lead::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * @test
     *
     * @group create-lead
     *
     * @dataProvider listarLeadsProvider
     *
     * A basic test example.
     */
    public function listLeads(
        int $perPage,
        int $page,
        int $perPageEsperado,
        int $pageEsperado,
        string|bool $search,
        string|bool $status
    ): void {

        \App\Models\Lead::factory()
            ->count(100)
            ->create();

        $perPageGet = $perPage != null ? '&per_page=' . $perPage : '';
        $pageGet = $page != null ? '&page=' . $page : '';
        $search = $search != false ? '&search=' . $search : '';
        $status = $status != false ? '&status=' . $status : '';

        $response = $this->rest()->getJson("api/leads?$perPageGet" . "$pageGet" . "$search" . "$status");

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
                'search' => false,
                'status' => false,
            ],
            'listar leads, valores padrão, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1,
                'search' => false,
                'status' => false,
            ],
            'listar leads, valores padrão com filtro search, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1,
                'search' => 't',
                'status' => false,
            ],
            'listar leads, valores padrão com filtro status, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1,
                'search' => 't',
                'status' => 'email_confirmed',
            ],
        ];
    }
}
