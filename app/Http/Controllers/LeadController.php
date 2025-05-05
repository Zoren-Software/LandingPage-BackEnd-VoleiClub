<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterStatusLeadRequest;
use App\Http\Requests\ConfirmEmailRequest;
use App\Http\Requests\ConfirmUnsubscribeEmailRequest;
use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\PaginateLeadsRequest;
use App\Http\Requests\UnsubscribeEmailRequest;
use App\Mail\AfterConfirmationEmail;
use App\Mail\ConfirmEmail;
use App\Mail\ConfirmUnsubscribeEmail;
use App\Models\Lead;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    /**
     * @unauthenticated
     *
     * @group Leads
     *
     * @return [type]
     */
    public function store(CreateLeadRequest $request)
    {
        $lead = new Lead();
        $lead->fill($request->all());
        $lead->save();

        Mail::mailer('smtp')
            ->to($lead->email)
            ->queue(new ConfirmEmail($lead));

        return response()->json([
            'message' => __('Leads.success'),
        ]);
    }

    /**
     * @unauthenticated
     *
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

        $lead->status_id = LeadStatus::where('name', 'email_confirmed')->first()->id;

        $lead->save();

        Mail::mailer('smtp')
            ->to($lead->email)
            ->queue(new AfterConfirmationEmail($lead));

        return response()->json([
            'message' => __('Leads.emailConfirmed'),
        ]);
    }

    /**
     * @unauthenticated
     *
     * @group Leads
     *
     * @return [type]
     */
    public function unsubscribe(UnsubscribeEmailRequest $request)
    {
        $lead = Lead::whereEmail($request->email)
            ->firstOrFail();

        // Definir o locale com base no parâmetro da URL
        if ($request->has('locale')) {
            app()->setLocale($request->input('locale'));
        }

        Mail::mailer('smtp')
            ->to($lead->email)
            ->queue(new ConfirmUnsubscribeEmail($lead));

        return response()->json([
            'message' => __('Leads.unsubscribe_receive_email'),
        ]);
    }

    /**
     * @unauthenticated
     *
     * @group Leads
     *
     * @return [type]
     */
    public function confirmUnsubscribeEmail(ConfirmUnsubscribeEmailRequest $request, int $id)
    {
        $lead = Lead::findOrFail($id);

        // Definir o locale com base no parâmetro da URL
        if ($request->has('locale')) {
            app()->setLocale($request->input('locale'));
        }

        $lead->email_verified_at = now();
        $lead->unsubscribed_at = now();

        $lead->status_id = LeadStatus::where('name', 'unsubscribed')->first()->id;

        $lead->save();

        return response()->json([
            'message' => __('Leads.unsubscribe_success'),
        ]);
    }

    /**
     * @group Leads
     *
     * @return [type]
     */
    public function list(PaginateLeadsRequest $request)
    {
        $leads = Lead::with('status')
            ->filtrar($request);

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
            'data' => $lead,
        ]);
    }
}
