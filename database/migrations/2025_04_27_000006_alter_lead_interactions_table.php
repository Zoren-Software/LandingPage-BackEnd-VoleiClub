<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Database\Seeders\MigrateDataLeadsStatusInteractionsTableSeeder;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('lead_interactions')) {
            Schema::table('lead_interactions', function (Blueprint $table) {

                if (!Schema::hasColumn('lead_interactions', 'status_id')) {
                    $table->unsignedBigInteger('status_id')->nullable()->after('lead_id');
                }
    
                if (!hasForeignKeyExist('lead_interactions', 'status_id')) {
                    $table->foreign('status_id')->references('id')->on('leads_status');
                }
            });
        }

        // Migrar os dados antigos para o novo relacionamento
        (new MigrateDataLeadsStatusInteractionsTableSeeder())->run();
    }

    public function down(): void
    {
        Schema::table('lead_interactions', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};