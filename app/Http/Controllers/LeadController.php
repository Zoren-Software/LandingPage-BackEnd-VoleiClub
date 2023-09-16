<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Http\Requests\CreateLeadRequest;

class LeadController extends Controller
{
    public function store(CreateLeadRequest $request)
    {
        Lead::create([
            'name' => request('name'),
            'email' => request('email'),
            'status' => 'new',
            'experience_level' => request('experience_level'),
            'message' => request('message'),
        ]);

        return response()->json([
            'message' => __('Leads.success'),
        ]);
    }
}
