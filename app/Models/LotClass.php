<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_class_name',
    ];

}
