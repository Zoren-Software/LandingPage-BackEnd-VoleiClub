<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        if (
            Schema::hasTable('lead_interactions') &&
            Schema::hasColumn('lead_interactions', 'id') &&
            !hasAutoIncrement('lead_interactions')
        ) {
            DB::statement(
                'ALTER TABLE lead_interactions MODIFY id BIGINT UNSIGNED AUTO_INCREMENT'
            );
        }

        if (Schema::hasTable('lead_interactions') && !hasForeignKeyExist('lead_interactions', 'lead_interactions_lead_id_foreign')) {
            Schema::table('lead_interactions', function (Blueprint $table) {
                $table->foreign('lead_id', 'lead_interactions_lead_id_foreign')
                    ->references('id')
                    ->on('leads')
                    ->onDelete('cascade');
            });
        }

        if (Schema::hasTable('lead_interactions') && !hasForeignKeyExist('lead_interactions', 'lead_interactions_user_id_foreign')) {
            Schema::table('lead_interactions', function (Blueprint $table) {
                $table->foreign('user_id', 'lead_interactions_user_id_foreign')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasTable('lead_interactions') &&
            Schema::hasColumn('lead_interactions', 'id') &&
            hasAutoIncrement('lead_interactions')
        ) {
            DB::statement(
                'ALTER TABLE lead_interactions MODIFY id BIGINT UNSIGNED NOT NULL'
            );
        }

        if (Schema::hasTable('lead_interactions') && hasForeignKeyExist('lead_interactions', 'lead_interactions_lead_id_foreign')) {
            Schema::table('lead_interactions', function (Blueprint $table) {
                $table->dropForeign('lead_interactions_lead_id_foreign');
            });
        }

        if (Schema::hasTable('lead_interactions') && hasForeignKeyExist('lead_interactions', 'lead_interactions_user_id_foreign')) {
            Schema::table('lead_interactions', function (Blueprint $table) {
                $table->dropForeign('lead_interactions_user_id_foreign');
            });
        }
    }
};
