<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterStatusLeadRequest;
use App\Http\Requests\ConfirmEmailRequest;
use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\DestroyLeadInteractionRequest;
use App\Http\Requests\PaginateLeadsInteractionsRequest;
use App\Mail\AfterConfirmationEmail;
use App\Mail\ConfirmEmail;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class LeadInteractionController extends Controller
{
    /**
     * @param Lead $lead
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $leadId, PaginateLeadsInteractionsRequest $request)
    {
        $lead = Lead::findOrFail($leadId);

        $perPage = $request->input('per_page', 15);

        $interactions = $lead->interactions()->with('user')->paginate($perPage);

        return response()->json($interactions);
    }

    /**
     * @param int $id
     * @param int $interactionId
     * @param DestroyLeadInteractionRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $leadId, int $interactionId)
    {
        $lead = Lead::findOrFail($leadId);

        $lead->interactions()->findOrFail($interactionId)->delete();

        return response()->json(
            [
                'message' => __('Leads.interaction_deleted'),
                'status' => 'success',
            ], 
        );
    }
}
