<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_type_id',
        'lot_class_id',
        'payment_name',
        'payment_type',
        'cash_full_price',
        'installment_full_price',
        'no_year',
        'installment_monthly_price',
        'with_rebate',
        'rebate_price',
        'min_amount',
    ];

    public function lotType()
    {
        return $this->belongsTo('App\Models\LotType', 'lot_type_id');
    }
    
    public function lotClass()
    {
        return $this->belongsTo('App\Models\LotClass', 'lot_class_id');
    }
    
}
