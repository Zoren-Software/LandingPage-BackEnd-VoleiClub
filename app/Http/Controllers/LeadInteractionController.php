<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditLeadInteractionRequest;
use App\Http\Requests\PaginateLeadsInteractionsRequest;
use App\Models\Lead;
use App\Models\LeadInteraction;

class LeadInteractionController extends Controller
{
    /**
     * @group Lead Interactions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $leadId, PaginateLeadsInteractionsRequest $request)
    {
        $lead = Lead::findOrFail($leadId);

        $perPage = $request->input('per_page', 15);

        $interactions = $lead->interactions()
            ->with('user', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json($interactions);
    }

    /**
     * @group Lead Interactions
     *
     * @return [type]
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

    /**
     * @group Lead Interactions
     *
     * @return [type]
     */
    public function update(EditLeadInteractionRequest $request, Lead $lead, LeadInteraction $interaction)
    {
        // NOTE - Verifica se a interação pertence ao lead
        if ($interaction->lead_id !== $lead->id) {
            return response()->json(['error' => trans('Leads.interaction_does_not_belong')], 403);
        }

        $interaction->update($request->validated());

        return response()->json(
            [
                'message' => 'Interação atualizada com sucesso.',
                'status' => 'success',
                'interaction' => $interaction,
            ],
            200
        );
    }
}
