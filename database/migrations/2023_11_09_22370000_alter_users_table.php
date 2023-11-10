<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasColumn('users', 'github_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('github_id')->nullable()->after('id');
            });
        }

        if(!Schema::hasColumn('users', 'auth_type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('auth_type')->nullable()->after('github_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'github_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                    'github_id',
                ]);
            });
        }

        if (Schema::hasColumn('users', 'auth_type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                    'auth_type',
                ]);
            });
        }
    }
};
