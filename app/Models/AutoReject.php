<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoReject extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_days',
    ];
}
