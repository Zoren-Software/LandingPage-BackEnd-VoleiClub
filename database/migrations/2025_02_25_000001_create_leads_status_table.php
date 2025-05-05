<?php

use Database\Seeders\LeadsStatusTableSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('leads_status')) {
            Schema::create('leads_status', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        (new LeadsStatusTableSeeder())->run();
    }

    public function down(): void
    {
        Schema::dropIfExists('leads_status');
    }
};
