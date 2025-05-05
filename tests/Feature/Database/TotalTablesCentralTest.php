<?php

namespace Tests\Feature\Database;

use Tests\TestCase;

class TotalTablesCentralTest extends TestCase
{
    protected $graphql = false;

    protected $tenancy = false;

    protected $login = false;

    /**
     * Verificar o número total de tabelas existentes.
     *
     * @test
     *
     * @return void
     */
    public function verifyTotalTables()
    {
        $tables = \DB::select('SHOW TABLES');
        $totalTables = count($tables);

        $this->assertEquals(
            8,
            $totalTables,
            PHP_EOL . PHP_EOL .
            'O número total de tabelas está incorreto.' . PHP_EOL .
            '    Verifique o banco de dados: ' . env('DB_DATABASE') . '.' . PHP_EOL .
            '    Verifique se todas as tabelas estão corretamente definidas.' . PHP_EOL .
            '    Ou se foram criadas mais tabelas e não foram consideradas.' . PHP_EOL .
            '    Este valor deve ser alterado manualmente no desenvolvimento.'
        );
    }
}
