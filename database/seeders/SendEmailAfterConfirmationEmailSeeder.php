<?php

namespace Database\Seeders;

use App\Mail\AfterConfirmationEmail;
use App\Models\Lead;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class SendEmailAfterConfirmationEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lead::whereNotNull('email_verified_at')->chunkById(100, function ($leads) {
            foreach ($leads as $lead) {
                Mail::mailer('smtp')
                    ->to($lead->email)
                    ->queue(new AfterConfirmationEmail($lead));
            }
        });
    }
}
