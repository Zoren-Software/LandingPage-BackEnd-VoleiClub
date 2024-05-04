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
     * @dataProvider listarLeadsProvider
     *
     * A basic test example.
     */
    public function listLeads($perPage, $page, int $perPageEsperado, int $pageEsperado): void
    {
        \App\Models\Lead::factory()->create();

        $perPageGet = $perPage != null ? '&per_page=' . $perPage : '';
        $pageGet = $page != null ? '&page=' . $page : '';

        $response = $this->rest()->get("api/leads?$perPageGet" . "$pageGet");

        $response->assertStatus(200);
    }

    public static function listarLeadsProvider()
    {
        return [
            'listar motivo inabilitação, setando valores por página, sucesso' => [
                'perPage' => 10,
                'page' => 2,
                'perPageEsperado' => 10,
                'pageEsperado' => 2
            ],
            'listar motivo inabilitação, valores padrão, sucesso' => [
                'perPage' => 10,
                'page' => 1,
                'perPageEsperado' => 10,
                'pageEsperado' => 1
            ]
        ];
    }

}
