<?php

namespace App\Rules;

use App\Models\LeadStatus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StatusLeadValidRule implements ValidationRule
{
    protected array $blockeds = [
        'unsubscribed',
        'email_confirmed',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $status = LeadStatus::find($value);

        if (! $status) {
            return;
        }

        if (in_array($status->name, $this->blockeds)) {
            $fail(__('Leads.status_id_blocked'));
        }
    }
}
