<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('personal_access_tokens', 'type')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->enum('type', ['web', 'mobile'])->after('name');
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('personal_access_tokens', 'type')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->dropColumn([
                    'type',
                ]);
                $table->dropSoftDeletes();
            });
        }
    }
};
