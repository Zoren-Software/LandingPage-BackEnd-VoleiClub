<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterStatusLeadRequest;
use App\Http\Requests\ConfirmEmailRequest;
use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\PaginateLeadsRequest;
use App\Mail\AfterConfirmationEmail;
use App\Mail\ConfirmEmail;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

class LeadInteractionController extends Controller
{
    /**
     * @param Lead $lead
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Lead $lead)
    {
        $perPage = $request->input('per_page', 15);

        $interactions = $lead->interactions()->with('user')->paginate($perPage);

        return response()->json($interactions);
    }
}
