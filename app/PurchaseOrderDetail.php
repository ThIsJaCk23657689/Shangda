<?php

namespace App;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Material as MaterialEloquent;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $fillable = [
        'material_id', 'purchaseOrder_id', 'count', 'price', 'quantity', 
        'discount', 'subTotal', 'comment',
    ];

    public $timestamps = false;

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrderEloquent::class, 'purchaseOrder_id');
    }
    
    public function material(){
        return $this->belongsTo(MaterialEloquent::class);
    }
}
