<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deceased extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'certificate_image',
        'born',
        'died',
        'age',
        'sex',
        'lot_id',
    ];

    public function lot()
    {
        return $this->belongsTo('App\Models\Lot', 'lot_id');
    }

    public function bones()
    {
        return $this->hasMany('App\Models\deceasedbone', 'deceased_id');
    }
    
}
