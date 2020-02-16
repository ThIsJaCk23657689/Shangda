<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SalesOrder as SalesOrderEloquent;

class SalesOrderDetail extends Model
{
    protected $fillable = [
        'saleOrder_id', 'product_id', 'price', 'count','quantity', 'discount',
        'subTotal', 'comment'
    ];

    public function saleOrder(){
        return $this->belongsTo(SalesOrderEloquent::class);
    }
}
