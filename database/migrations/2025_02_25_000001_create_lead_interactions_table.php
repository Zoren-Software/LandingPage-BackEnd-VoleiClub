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
        if (! Schema::hasTable('lead_interactions')) {
            Schema::create('lead_interactions', function (Blueprint $table) {
                $table->bigInteger('id')->primary();
                $table->unsignedBigInteger('lead_id');
                $table->unsignedBigInteger('status_id')
                    ->nullable()
                    ->default(1);
                $table->text('message')->nullable();
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('user_id')
                    ->nullable();
                $table->timestamps();
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
