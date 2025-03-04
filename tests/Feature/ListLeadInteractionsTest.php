<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListLeadInteractionsTest extends TestCase
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

        $perPageGet = $perPage != null ? '&per_page=' . $perPage : '';
        $pageGet = $page != null ? '&page=' . $page : '';

        $response = $this->rest()->getJson("api/leads/$lead->id/interactions?$perPageGet" . "$pageGet");

        $response->assertStatus(200);
    }

    public static function listarLeadsProvider()
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
