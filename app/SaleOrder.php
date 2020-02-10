<?php

namespace App;

use App\Product as ProductEloquent;
use App\Consumer as ConsumerEloquent;
use App\User as UserEloquent;
use App\SaleOrderDetail as SaleOrderDetailEloquent;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    protected $fillable = [
        'consumers_id', 'user_id', 'last_user_id', 'expectPay_at', 'paid_at', 'expectDeliver_at',
        'delivered_at', 'makeInvoice_at', 'piadAmount', 'unpiadAmount', 'totalPrice',
        'taxPrice', 'totalTaxPrice', 'comment', 'taxType', 'invoiceType', 'address',
    ];

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function consumers(){
        return $this->belongsTo(ConsumerEloquent::class);
    }

    public function products(){
        return $this->belongsToMany(ProductEloquent::class)
        ->withPivot('price', 'quantity', 'subTotal', 'comment', 'discount');
    }

    public function details(){
        return $this->hasMany(SaleOrderDetailEloquent::class);
    }
}
