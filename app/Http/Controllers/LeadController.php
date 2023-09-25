<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmEmailRequest;
use App\Http\Requests\CreateLeadRequest;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmEmail;

class LeadController extends Controller
{
    public function store(CreateLeadRequest $request)
    {
        $lead = Lead::create([
            'name' => request('name'),
            'email' => request('email'),
            'status' => 'new',
            'experience_level' => request('experience_level'),
            'message' => request('message'),
        ]);

        Mail::mailer('smtp')
            ->to($lead->email)
            ->queue(new ConfirmEmail($lead));

        return response()->json([
            'message' => __('Leads.success'),
        ]);
    }

    public function confirmEmail(ConfirmEmailRequest $request, int $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->email_verified_at = now();
        $lead->save();

        return response()->json([
            'message' => __('Leads.emailConfirmed'),
        ]);
    }
}
