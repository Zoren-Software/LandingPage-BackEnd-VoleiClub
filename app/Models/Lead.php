<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'status',
        'experience_level',
        'message',
    ];

    public function interactions()
    {
        return $this->hasMany(LeadInteraction::class);
    }

    public function alterStatus($request)
    {
        $this->findOrFail($request->input('id'));
        $this->status = $request->input('status') ?? $this->status;
        $this->tenant_id = $request->input('tenantId') ?? $this->tenant_id;
        $this->save();

        $this->createInteraction($request);

        return $this;
    }

    private function createInteraction($request)
    {
        $this->interactions()->create([
            'status' => $request->input('status') ?? $this->status,
            'user_id' => auth()->id(),
            'message' => $request->input('message') ?? null,
            'notes' => $request->input('notes') ?? null,
        ]);
    }

    public function scopeFiltrar($query, $request)
    {
        $query->filterId($request)
            ->filterStatus($request)
            ->search($request);
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('search')) {
            $query->where('name', 'like', $request->input('search'));
            $query->orWhere('tenant_id', 'like', $request->input('search'));
        }
    }

    public function scopeFilterId($query, $request)
    {
        if ($request->has('id')) {
            $query->where('id', $request->input('id'));
        }
    }

    public function scopeFilterStatus($query, $request)
    {
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
    }
}
