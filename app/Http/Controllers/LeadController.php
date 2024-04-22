<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmEmailRequest;
use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\PaginateLeadsRequest;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmEmail;
use App\Mail\AfterConfirmationEmail;

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

        // Definir o locale com base no parâmetro da URL
        if ($request->has('locale')) {
            app()->setLocale($request->input('locale'));
        }

        $lead->email_verified_at = now();
        $lead->save();

        Mail::mailer('smtp')
            ->to($lead->email)
            ->queue(new AfterConfirmationEmail($lead));

        return response()->json([
            'message' => __('Leads.emailConfirmed'),
        ]);
    }

    public function list(PaginateLeadsRequest $request)
    {
        try {
            $leads = Lead::filtrar($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json($leads->paginate());
    }
}
