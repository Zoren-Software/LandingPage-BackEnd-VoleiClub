<?php

use Illuminate\Database\Migrations\Migration;
use Database\Seeders\SendEmailAfterConfirmationEmailSeeder;

return new class () extends Migration {
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
