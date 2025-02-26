<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (
            Schema::hasTable('leads') &&
            Schema::hasColumn('leads', 'id') &&
            ! hasAutoIncrement('leads')
        ) {
            DB::statement(
                'ALTER TABLE leads MODIFY id BIGINT UNSIGNED AUTO_INCREMENT'
            );
        }

        if (Schema::hasTable('leads') && ! hasIndexExist('leads', 'leads_email_unique')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->unique('email', 'leads_email_unique');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasTable('leads') &&
            Schema::hasColumn('leads', 'id') &&
            hasAutoIncrement('leads')
        ) {
            DB::statement(
                'ALTER TABLE leads MODIFY id BIGINT UNSIGNED NOT NULL'
            );
        }

        if (Schema::hasTable('leads') && hasIndexExist('leads', 'leads_email_unique')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->dropUnique('leads_email_unique');
            });
        }
    }
};
