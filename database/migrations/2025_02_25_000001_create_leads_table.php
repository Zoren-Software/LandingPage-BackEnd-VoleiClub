<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->bigInteger('id')->primary();
                $table->string('tenant_id')
                    ->nullable();
                $table->unsignedBigInteger('status_id')
                    ->nullable()
                    ->default(1);
                $table->string('name');
                $table->string('email');
                $table->timestamp('email_verified_at')
                    ->nullable();
                $table->timestamp('unsubscribed_at')
                    ->nullable();
                $table->enum(
                    'experience_level',
                    [
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]
                )->default('beginner');
                $table->text('message');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
