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
        'status_id',
        'name',
        'email',
        'experience_level',
        'message',
    ];

    protected $casts = [
        'unsubscribed_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function interactions()
    {
        return $this->hasMany(LeadInteraction::class);
    }

    public function alterStatus($request)
    {
        $this->findOrFail($request->input('id'));
        $this->status_id = $request->input('status_id') ?? $this->status_id;
        $this->tenant_id = $request->input('tenantId') ?? $this->tenant_id;
        $this->save();

        $this->createInteraction($request);

        return $this;
    }

    private function createInteraction($request)
    {
        // TODO - Parei na revisão por aqui
        $this->interactions()->create([
            'status_id' => $request->input('status_id') ?? $this->status_id,
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
            $query->filterId($request);
        }
    }

    public function scopeFilterId($query, $request)
    {
        $query->orWhere('id', $request->input('search'));
    }

    public function scopeFilterStatus($query, $request)
    {
        if ($request->has('status')) {
            $query->whereHas('status', function ($query) use ($request) {
                $query->where('name', $request->input('status'));
            });
        }
    }

    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'status_id');
    }
}
