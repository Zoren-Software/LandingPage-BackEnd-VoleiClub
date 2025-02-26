<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (
            Schema::hasTable('personal_access_tokens') &&
            Schema::hasColumn('personal_access_tokens', 'id') &&
            !hasAutoIncrement('personal_access_tokens')
        ) {
            DB::statement(
                'ALTER TABLE personal_access_tokens MODIFY id BIGINT UNSIGNED AUTO_INCREMENT'
            );
        }

        if (Schema::hasTable('personal_access_tokens') && !hasIndexExist('personal_access_tokens', 'personal_access_tokens_token_unique')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->unique('token', 'personal_access_tokens_token_unique');
            });
        }

        if (Schema::hasTable('personal_access_tokens') && !hasIndexExist('personal_access_tokens', 'personal_access_tokens_tokenable_type_tokenable_id_index')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->index(['tokenable_type', 'tokenable_id'], 'personal_access_tokens_tokenable_type_tokenable_id_index');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasTable('personal_access_tokens') &&
            Schema::hasColumn('personal_access_tokens', 'id') &&
            hasAutoIncrement('personal_access_tokens')
        ) {
            DB::statement(
                'ALTER TABLE personal_access_tokens MODIFY id BIGINT UNSIGNED NOT NULL'
            );
        }

        if (Schema::hasTable('personal_access_tokens') && hasIndexExist('personal_access_tokens', 'personal_access_tokens_token_unique')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->dropUnique('personal_access_tokens_token_unique');
            });
        }

        if (Schema::hasTable('personal_access_tokens') && hasIndexExist('personal_access_tokens', 'personal_access_tokens_tokenable_type_tokenable_id_index')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->dropIndex('personal_access_tokens_tokenable_type_tokenable_id_index');
            });
        }
    }
};
