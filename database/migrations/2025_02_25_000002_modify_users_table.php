<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (
            Schema::hasTable('users') &&
            Schema::hasColumn('users', 'id') &&
            !hasAutoIncrement('users')
        ) {
            DB::statement(
                'ALTER TABLE users MODIFY id BIGINT UNSIGNED AUTO_INCREMENT'
            );
        }

        if (Schema::hasTable('users') && !hasIndexExist('users', 'users_email_unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('email', 'users_email_unique');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasTable('users') &&
            Schema::hasColumn('users', 'id') &&
            hasAutoIncrement('users')
        ) {
            DB::statement(
                'ALTER TABLE users MODIFY id BIGINT UNSIGNED NOT NULL'
            );
        }

        if (Schema::hasTable('users') && hasIndexExist('users', 'users_email_unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique('users_email_unique');
            });
        }
    }
};