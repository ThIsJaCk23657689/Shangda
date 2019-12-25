<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier as SupplierEloquent;
use App\User as UserEloquent;
use App\Material as MaterialEloquent;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id', 'user_id', 'paid_at', 'received_at', 'expectReceived_at', 
        'totalPrice', 'comment', 'taxType', 'invoiceType', 'address',
    ];

    public function supplier(){
        return $this->belongsTo(SupplierEloquent::class);
    }
    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function materials(){
        return $this->belongsToMany(MaterialEloquent::class)
        ->withPivot('price', 'quantity', 'subTotal', 'comment', 'discount');
    }
}
