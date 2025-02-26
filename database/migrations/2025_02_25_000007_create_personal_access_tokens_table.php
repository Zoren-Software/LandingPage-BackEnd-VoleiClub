<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('personal_access_tokens')) {
            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->bigInteger('id'); // AUTO_INCREMENT será tratado na segunda migration
                $table->string('tokenable_type', 255);
                $table->bigInteger('tokenable_id');
                $table->string('name');
                $table->enum('type', ['web', 'mobile']);
                $table->string('token', 64);
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
