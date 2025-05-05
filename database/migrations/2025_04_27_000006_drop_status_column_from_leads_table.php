<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('leads')) {
            Schema::table('leads', function (Blueprint $table) {
                if (Schema::hasColumn('leads', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('leads')) {
            if (! Schema::hasColumn('leads', 'status')) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->enum(
                        'status',
                        [
                            'new',
                            'contacted',
                            'converted',
                            'unqualified',
                            'qualified',
                            'bad_email',
                            'spam',
                            'test',
                            'trial_period',
                            'active_customer',
                            'unsubscribe',
                        ]
                    )->default('new');
                });
            }
        }
    }
};
