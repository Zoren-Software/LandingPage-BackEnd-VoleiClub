<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'leads_status';

    protected $fillable = [
        'name',
    ];

    public function scopeFiltrar($query, $request)
    {
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        return $query;
    }
}
