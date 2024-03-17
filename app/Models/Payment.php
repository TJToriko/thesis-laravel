<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_id',
        'payment_setting_id',
        'customer_id',
        'status',
        'total_amount_paid',
        'total_rebate_amount',
        'pay_thru',
        'downpayment',
        'lot_transfer',
        'date_collected',
        'date_to_collect',
        'type_paid',
        'cancel_reason',
    ];

    public function lot()
    {
        return $this->belongsTo('App\Models\Lot', 'lot_id');
    }

    public function paymentsetting()
    {
        return $this->belongsTo('App\Models\PaymentSetting', 'payment_setting_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

}
