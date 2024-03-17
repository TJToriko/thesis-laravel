<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'province',
        'city',
        'barangay',
        'street',
        'landmark',
        'email',
        'cp_no',
        'occupation',
        'place_of_birth',
        'date_of_birth',
        'sex',
        'benificiary_fullname',
        'benificiary_date_of_birth',
        'relationship',
        'id_image',
    ];
}
