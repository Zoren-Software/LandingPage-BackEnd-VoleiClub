<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListLeadStatusTest extends TestCase
{
    protected $login = true;

    private $dataStructure = [
        'current_page',
        'data' => [
            '*' => [
                'id',
                'name',
                'created_at',
                'updated_at',
                'deleted_at',
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
    public function listLeadsStatus($perPage, $page, int $perPageEsperado, int $pageEsperado, string|bool $search): void
    {
        $perPageGet = $perPage != null ? '&per_page=' . $perPage : '';
        $pageGet = $page != null ? '&page=' . $page : '';

        if ($search != false) {
            $searchGet = '&search=' . $search;
        } else {
            $searchGet = '';
        }

        $response = $this->rest()->getJson("api/leads-status?$perPageGet" . "$pageGet" . "$searchGet");

        $response->assertStatus(200);

        $response->assertJsonStructure($this->dataStructure);

        $this->assertEquals($perPageEsperado, $response['per_page']);
        $this->assertEquals($pageEsperado, $response['current_page']);
    }

    public static function listarLeadsProvider()
    {
        return [
            'listar leads status, setando valores por página, sucesso' => [
                'perPage' => 10,
                'page' => 2,
                'perPageEsperado' => 10,
                'pageEsperado' => 2,
                'search' => false,
            ],
            'listar leads status, valores padrão, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1,
                'search' => false,
            ],
            'listar leads status, valores com filtro name, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1,
                'search' => 'n',
            ],
        ];
    }
}
