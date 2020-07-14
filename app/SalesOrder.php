<?php

namespace App;

use App\Product as ProductEloquent;
use App\Consumer as ConsumerEloquent;
use App\User as UserEloquent;
use App\SalesOrderDetail as SalesOrderDetailEloquent;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'consumer_id', 'shown_id', 'user_id', 'last_user_id', 'expectPay_at', 'paid_at', 'expectDeliver_at',
        'delivered_at', 'makeInvoice_at', 'piadAmount', 'unpiadAmount', 'totalPrice',
        'taxPrice', 'totalTaxPrice', 'comment', 'taxType', 'status', 'invoiceType', 'address','who_created','confirmStatus',
    ];

    protected $casts = [
        'expectPay_at' => 'datetime',
        'paid_at' => 'datetime',
        'expectDeliver_at' => 'datetime',
        'delivered_at' => 'datetime',
        'makeInvoice_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function consumer(){
        return $this->belongsTo(ConsumerEloquent::class);
    }

    public function products(){
        return $this->belongsToMany(ProductEloquent::class)
        ->withPivot('price', 'quantity', 'subTotal', 'comment', 'discount');
    }

    public function details(){
        return $this->hasMany(SalesOrderDetailEloquent::class);
    }

    public function showExpectDeliverAtDate(){
        return is_null($this->expectDeliver_at) ? '無' : $this->expectDeliver_at->format($this->dateFormat ?: 'Y-m-d');
    }

    public function showBeforePrice(){
        if($this->taxType == 1){
            return round($this->totalPrice * 0.95, 4);
        }else{
            return $this->totalPrice;
        }
    }

    public function showTaxPrice(){
        if($this->taxType == 1){
            return round($this->totalPrice * 0.05, 4);
        }else{
            return 0;
        }
    }


    public function showTaxType(){
        return (config('shangda.tax.' . $this->taxType)) ?? '未知編號：'. $this->taxType;
    }

    public function showInvoiceType(){
        return (config('shangda.invoice.' . $this->invoiceType)) ?? '未知編號：'. $this->invoiceType;
    }
}
