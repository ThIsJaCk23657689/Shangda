<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrder as PurchaseOrderEloquent;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'shortName', 'taxId', 'tel', 'tax',
        'inCharge1', 'tel1', 'email1', 'inCharge2', 'tel2', 'email2',
        'companyAddress_zipcode', 'companyAddress_county',  'companyAddress_district', 'companyAddress_others',
        'comment',
    ];

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrderEloquent::class);
    }
}
