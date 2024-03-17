<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotType extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_type_name',
    ];

    public function lots()
    {
        return $this->hasMany(Lot::class, 'lot_type_id');
    }
}
