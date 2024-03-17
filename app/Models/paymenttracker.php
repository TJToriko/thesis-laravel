<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymenttracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'date',
        'due_date',
        'payment_status',
        'amount_paid',
        'price_monthly',
        'customer_id',
        'type',
    ];

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }

}
