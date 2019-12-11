<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrder as PurchaseOrderEloquent;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'email', 'tel', 'taxId', 'shortName', 'inCharge1', 'tel1', 'email1', 'inCharge2', 'tel2', 'email2',
        'tax', 'companyAddress', 'deliveryAddress',  'invoiceAddress', 'comment',
    ];

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrderEloquent::class);
    }
}
