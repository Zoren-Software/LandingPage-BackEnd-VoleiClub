<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateLeadsStatusRequest;
use App\Models\LeadStatus;

class LeadStatusController extends Controller
{
    /**
     * @group LeadsStatus
     *
     * @return [type]
     */
    public function list(PaginateLeadsStatusRequest $request)
    {
        try {
            $leads = LeadStatus::query()
                ->filtrar($request);
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
}
