<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SaleOrder as SaleOrderEloquent;

class SaleOrderDetail extends Model
{
    protected $fillable = [
        'saleOrder_id', 'product_id', 'price', 'count','quantity', 'discount',
        'subTotal', 'comment'
    ];

    public function saleOrder(){
        return $this->belongsTo(SaleOrderEloquent::class);
    }
}
