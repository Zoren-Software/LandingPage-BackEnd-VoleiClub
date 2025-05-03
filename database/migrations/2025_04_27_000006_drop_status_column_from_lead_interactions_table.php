<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('leads')) {
            Schema::table('lead_interactions', function (Blueprint $table) {
                if (Schema::hasColumn('lead_interactions', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('lead_interactions')) {
            if (! Schema::hasColumn('lead_interactions', 'status')) {
                Schema::table('lead_interactions', function (Blueprint $table) {
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
