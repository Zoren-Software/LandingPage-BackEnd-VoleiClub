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
        if (! Schema::hasColumn('leads', 'type')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->enum('status', 
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
                    ]
                )
                ->default('new')
                ->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('leads', 'type')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->enum('status', 
                    [
                        'new',
                        'contacted',
                        'converted',
                        'unqualified',
                        'qualified',
                        'bad_email',
                        'spam',
                    ]
                )
                ->default('new')
                ->change();
            });
        }
    }
};
