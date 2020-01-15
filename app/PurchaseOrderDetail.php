<?php

namespace App;
use App\PurchaseOrder as PurchaseOrderEloquent;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $fillable = [
        'material_id', 'purchaseOrder_id', 'count', 'price', 'quantity', 
        'discount', 'subTotal', 'comment',
    ];

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrderEloquent::class);
    }
    public $timestamps = false;
}
