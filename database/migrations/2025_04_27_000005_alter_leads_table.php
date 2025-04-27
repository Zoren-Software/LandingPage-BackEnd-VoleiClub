<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Database\Seeders\MigrateDataLeadsStatusTableSeeder;

return new class extends Migration
{
    public function up(): void
    {
        if (
            Schema::hasTable('leads')
        ) {
            
            Schema::table('leads', function (Blueprint $table) {

                if (!Schema::hasColumn('leads', 'status_id')) {
                    $table->unsignedBigInteger('status_id')->nullable()->after('tenant_id');
                }
    
                if (!hasForeignKeyExist('leads', 'status_id')) {
                    $table->foreign('status_id')->references('id')->on('leads_status');
                }
            });
        }

        // Migrar os dados antigos para o novo relacionamento
        (new MigrateDataLeadsStatusTableSeeder())->run();
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};