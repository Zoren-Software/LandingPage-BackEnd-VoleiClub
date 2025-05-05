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
        $leads = LeadStatus::query()
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
}
