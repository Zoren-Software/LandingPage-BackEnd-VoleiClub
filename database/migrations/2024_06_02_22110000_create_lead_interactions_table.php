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
        if (Schema::hasTable('lead_interactions')) {
            return;
        }

        Schema::create('lead_interactions', function (Blueprint $table) {
            $table->id();
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
            $table->timestamps();

            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
