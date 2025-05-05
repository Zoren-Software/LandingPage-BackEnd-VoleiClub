<?php

namespace Database\Seeders;

use App\Models\LeadInteraction;
use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class MigrateDataLeadsStatusInteractionsTableSeeder extends Seeder
{
    /**
     * NOTE - Seeder apagável
     *
     * Seed the application's database.
     */
    public function run(): void
    {
        $statuses = LeadStatus::get()->pluck('id', 'name');

        foreach ($statuses as $name => $id) {
            LeadInteraction::where('status', $name)
                ->update(['status_id' => $id]);
        }
    }
}
