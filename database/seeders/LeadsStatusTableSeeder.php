<?php

namespace Database\Seeders;

use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class LeadsStatusTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $statuses = [
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
            'unsubscribe',
        ];

        foreach ($statuses as $status) {
            LeadStatus::updateOrInsert(['name' => $status]);
        }
    }
}
