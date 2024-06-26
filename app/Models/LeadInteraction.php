<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'status',
        'user_id',
        'message',
        'notes',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
