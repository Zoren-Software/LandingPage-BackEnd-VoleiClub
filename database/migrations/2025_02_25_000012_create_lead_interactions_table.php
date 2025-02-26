<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('lead_interactions')) {
            Schema::create('lead_interactions', function (Blueprint $table) {
                $table->bigInteger('id'); // AUTO_INCREMENT será tratado na segunda migration
                $table->unsignedBigInteger('lead_id');
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
                    ]
                );
                $table->text('message')->nullable();
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_interactions');
    }
};
