<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrder as PurchaseOrderEloquent;

class Material extends Model
{
    protected $fillable = [
        'name', 'shortName', 'comment', 'internationalNum', 'unit', 'unitPrice', 'stock', 'picture',
    ];

    // public function purchaseOrders(){
    //     return $this->belongsToMany(PurchaseOrderEloquent::class)
    //     ->withPivot('price','totalPrice','quantity','comment','discount');
    // }
}
