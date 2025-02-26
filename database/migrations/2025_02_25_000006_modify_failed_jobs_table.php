<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (
            Schema::hasTable('failed_jobs') &&
            Schema::hasColumn('failed_jobs', 'id') &&
            !hasAutoIncrement('failed_jobs')
        ) {
            DB::statement(
                'ALTER TABLE failed_jobs MODIFY id BIGINT UNSIGNED AUTO_INCREMENT'
            );
        }

        if (Schema::hasTable('failed_jobs') && !hasIndexExist('failed_jobs', 'failed_jobs_uuid_unique')) {
            Schema::table('failed_jobs', function (Blueprint $table) {
                $table->unique('uuid', 'failed_jobs_uuid_unique');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasTable('failed_jobs') &&
            Schema::hasColumn('failed_jobs', 'id') &&
            hasAutoIncrement('failed_jobs')
        ) {
            DB::statement(
                'ALTER TABLE failed_jobs MODIFY id BIGINT UNSIGNED NOT NULL'
            );
        }

        if (Schema::hasTable('failed_jobs') && hasIndexExist('failed_jobs', 'failed_jobs_uuid_unique')) {
            Schema::table('failed_jobs', function (Blueprint $table) {
                $table->dropUnique('failed_jobs_uuid_unique');
            });
        }
    }
};
