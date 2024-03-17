<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'lot_no',
        'lot_type_id',
        'lot_class_id',
        'lot_status',
        'lot_title',
        'deed_of_sale',
        'customer_id',
    ];

    public function lotType(){
        return $this->belongsTo(lotType::class);
    }
    
    public function lotClass(){
        return $this->belongsTo(lotClass::class);
    }

    public function customer(){
        return $this->belongsTo(User::class);
    }
}
