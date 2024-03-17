<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maxdeceasedqty extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_quantity_deceased',
        'max_quantity_bones',
    ];
}
