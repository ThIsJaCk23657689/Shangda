<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier as SupplierEloquent;
use App\PurchaseOrder as PurchaseOrderEloquent;

class Material extends Model
{
    protected $fillable = [
        'name', 'shortName', 'comment', 'internationalNum', 'unit', 'unitPrice', 'stock', 'picture',
    ];

    public function suppliers(){
        return $this->belongsToMany(SupplierEloquent::class);
    }

    public function purchaseOrders(){
        return $this->belongsToMany(PurchaseOrderEloquent::class)
        ->withPivot('price','totalPrice','quantity','comment','discount');
    }
}
