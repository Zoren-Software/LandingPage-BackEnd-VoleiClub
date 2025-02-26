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
                $table->string('name');
                $table->string('email');
                $table->timestamp('email_verified_at')
                    ->nullable();
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
                )->default('new');
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
