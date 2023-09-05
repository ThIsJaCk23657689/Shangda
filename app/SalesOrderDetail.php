<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SalesOrder as SalesOrderEloquent;
use App\Product as ProductEloquent;

class SalesOrderDetail extends Model
{
    protected $fillable = [
        'sales_order_id', 'product_id', 'price', 'count','quantity', 'discount',
        'subTotal', 'comment'
    ];

    public $timestamps = false;

    public function salesOrder(){
        return $this->belongsTo(SalesOrderEloquent::class);
    }

    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }

}
