<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class MigrateDataLeadsStatusIDTableSeeder extends Seeder
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
            Lead::whereHas('status', function ($query) use ($name) {
                $query->where('name', $name);
            })->update(['status_id' => $id]);
        }
    }
}
