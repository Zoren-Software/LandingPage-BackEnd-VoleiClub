<?php

use Database\Seeders\SendEmailAfterConfirmationEmailSeeder;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        (new SendEmailAfterConfirmationEmailSeeder())->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Irreversible migration
    }
};
