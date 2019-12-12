<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    protected $fillable = [
        'consumers_id', 'user_id', 'expectPay_at', 'paid_at', 'expectDeliver_at', 
        'delivered_at', 'makeInvoice_at', 'piadAmount', 'unpiadAmount', 'totalPrice', 
        'taxPrice', 'totalTaxPrice', 'comment', 'taxType', 'invoiceType', 'address', 
    ];
}
