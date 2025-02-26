<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 🚀 Alterando a PRIMARY KEY da tabela password_reset_tokens
        if (
            Schema::hasTable('password_reset_tokens') &&
            Schema::hasColumn('password_reset_tokens', 'email') &&
            ! hasPrimaryKey('password_reset_tokens')
        ) {
            DB::statement(
                'ALTER TABLE password_reset_tokens ADD PRIMARY KEY (email)'
            );
        }
    }

    public function down(): void
    {
        // 🚀 Removendo a PRIMARY KEY da tabela password_reset_tokens
        if (
            Schema::hasTable('password_reset_tokens') &&
            hasPrimaryKey('password_reset_tokens')
        ) {
            DB::statement(
                'ALTER TABLE password_reset_tokens DROP PRIMARY KEY'
            );
        }
    }
};
