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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table
                ->enum(
                    'status',
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
                ->default('new');
            $table->enum(
                'experience_level',
                [
                    'beginner',
                    'amatuer',
                    'student',
                    'college',
                    'semi-professional',
                    'professional',
                    'intermediate',
                    'coach',
                    'instructor',
                    'other',
                ]
            )
                ->default('beginner');
            $table->text('message');
            $table->timestamps();

            $table->unique('email');
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
