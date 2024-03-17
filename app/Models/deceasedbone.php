<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deceasedbone extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'born',
        'died',
        'sex',
        'age',
        'deceased_id',
    ];

    public function deceased()
    {
        return $this->belongsTo('App\Models\deceased', 'deceased_id');
    }
    
}
