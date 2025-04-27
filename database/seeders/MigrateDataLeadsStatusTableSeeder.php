<?php

namespace Database\Seeders;

use App\Models\LeadStatus;
use App\Models\Lead;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MigrateDataLeadsStatusTableSeeder extends Seeder
{
    /**
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
