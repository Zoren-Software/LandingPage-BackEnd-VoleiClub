<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('password_reset_tokens') && !hasIndexExist('password_reset_tokens', 'password_reset_tokens_email_primary')) {
            Schema::table('password_reset_tokens', function (Blueprint $table) {
                $table->primary('email', 'password_reset_tokens_email_primary');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('password_reset_tokens') && hasIndexExist('password_reset_tokens', 'password_reset_tokens_email_primary')) {
            Schema::table('password_reset_tokens', function (Blueprint $table) {
                $table->dropPrimary('password_reset_tokens_email_primary');
            });
        }
    }
};
