<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterStatusLeadRequest;
use App\Http\Requests\ConfirmEmailRequest;
use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\PaginateLeadsRequest;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmEmail;
use App\Mail\AfterConfirmationEmail;

class LeadController extends Controller
{
    /**
     * 
     * @param CreateLeadRequest $request
     * 
     * @unauthenticated
     * @group Leads
     * 
     * @return [type]
     */
    public function store(CreateLeadRequest $request)
    {
        $lead = Lead::create([
            'tenant_id' => request('tenant_id'),
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

    /**
     * @param ConfirmEmailRequest $request
     * @param int $id
     * 
     * @unauthenticated
     * @group Leads
     * 
     * @return [type]
     */
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

    /**
     * @param PaginateLeadsRequest $request
     * 
     * @group Leads
     * 
     * @return [type]
     */
    public function list(PaginateLeadsRequest $request)
    {
        try {
            $leads = Lead::filtrar($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json(
            $leads->paginate(
                $request->input('per_page', 15), 
                ['*'], 
                'page', 
                $request->input('page', 1)
            ),
        );
    }

    /**
     * @param AlterStatusLeadRequest $request
     * 
     * @group Leads
     * 
     * @return [type]
     */
    public function alterStatusLead(AlterStatusLeadRequest $request)
    {
        $lead = new Lead();
        $lead = $lead->findOrFail($request->input('id'));
        $lead->alterStatus($request);

        return response()->json([
            'message' => __('Leads.success_edit_status'),
            'data'  => $lead,
        ]);
    }
}
