<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterStatusLeadRequest;
use App\Http\Requests\ConfirmEmailRequest;
use App\Http\Requests\ConfirmUnsubscribeEmailRequest;
use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\PaginateLeadsStatusRequest;
use App\Http\Requests\UnsubscribeEmailRequest;
use App\Mail\AfterConfirmationEmail;
use App\Mail\ConfirmEmail;
use App\Mail\ConfirmUnsubscribeEmail;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\Mail;

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
