<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier as SupplierEloquent;
use App\User as UserEloquent;
use App\PurchaseOrderDetail as PurchaseOrderDetailEloquent;
// use App\Material as MaterialEloquent;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id', 'user_id', 'paid_at', 'received_at', 'expectReceived_at', 
        'totalPrice', 'comment', 'taxType', 'invoiceType', 'address', 'shown_id'
    ];

    public function supplier(){
        return $this->belongsTo(SupplierEloquent::class);
    }

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function details(){
        return $this->hasMany(PurchaseOrderDetailEloquent::class, 'purchaseOrder_id');
    }

    public function showTaxType(){
        return (config('shangda.tax.' . $this->taxType)) ?? '未知編號：'. $this->taxType;
    }

    public function showInvoiceType(){
        return (config('shangda.invoice.' . $this->invoiceType)) ?? '未知編號：'. $this->invoiceType;
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

    // public function materials(){
    //     return $this->belongsToMany(MaterialEloquent::class)
    //     ->withPivot('price', 'quantity', 'subTotal', 'comment', 'discount');
    // }
}
