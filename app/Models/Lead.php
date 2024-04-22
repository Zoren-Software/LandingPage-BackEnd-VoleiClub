<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'status',
        'experience_level',
        'message',
    ];

    public function alterStatus($request) {
        $this->findOrFail($request->input('id'));
        $this->status = $request->input('status');
        $this->save();

        return $this;
    }

    public function scopeFiltrar($query, $request) {
        $query->filterId($request)
            ->filterStatus($request)
            ->search($request);
    }

    public function scopeSearch($query, $request) {
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
    }

    public function scopeFilterId($query, $request) {
        if ($request->has('id')) {
            $query->where('id', $request->input('id'));
        }
    }

    public function scopeFilterStatus($query, $request) {
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
    }
}
