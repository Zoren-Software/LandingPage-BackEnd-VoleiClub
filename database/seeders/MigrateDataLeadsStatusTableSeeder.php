<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class MigrateDataLeadsStatusTableSeeder extends Seeder
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
            Lead::where('status', $name)
                ->update(['status_id' => $id]);
        }
    }
}
