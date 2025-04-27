<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = 'leads_status';

    protected $fillable = [
        'name',
    ];
}