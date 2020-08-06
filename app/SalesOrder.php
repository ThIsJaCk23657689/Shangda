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

    public function scopeOfStatus($query, $status){
        switch($status){
            // 0.所有訂單 1.未付款未出貨訂單 2.已付款未出貨訂單 3.未付款已出貨訂單 4.已完成訂單
            case 0:
                return $query;
                break;
            case 1:
                return $query->whereNull('paid_at')->whereNull('delivered_at');
                break;
            case 2:
                return $query->whereNotNull('paid_at')->whereNull('delivered_at');
                break;
            case 3:
                return $query->whereNull('paid_at')->whereNotNull('delivered_at');
                break;
            case 4:
                return $query->whereNotNull('paid_at')->whereNotNull('delivered_at');
                break;
            default:
                return $query;
        }
    }

    public function showExpectDeliverAtDate(){
        return is_null($this->expectDeliver_at) ? '無' : $this->expectDeliver_at->format($this->dateFormat ?: 'Y-m-d');
    }

    public function showCreatedDate(){
        return is_null($this->created_at) ? '無' : $this->created_at->format($this->dateFormat ?: 'Y-m-d');
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

    public function showSaleOrderStatus(){
        if(!is_null($this->paid_at) && !is_null($this->delivered_at)){
            $result = "訂單已完成";
        }elseif(!is_null($this->paid_at) && is_null($this->delivered_at)){
            $result = "訂單已付款，未出貨";
        }elseif(is_null($this->paid_at) && !is_null($this->delivered_at)){
            $result = "訂單已付款，未出貨";
        }else{
            $result = "訂單未付款，且未出貨";
        }

        return $result;
    }
}
