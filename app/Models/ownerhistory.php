<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ownerhistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_id',
        'customer_id',
        'date',
        'lot_title',
        'deed_of_sale',
    ];
}
