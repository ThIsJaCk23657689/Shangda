<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Material_log as Material_logEloquent;

class Material extends Model
{
    protected $fillable = [
        'name', 'shortName', 'comment', 'internationalNum', 'unit', 'unitPrice', 'stock', 'picture',
    ];

    public function purchaseOrders(){
        return $this->belongsToMany(PurchaseOrderEloquent::class)
        ->withPivot('price','totalPrice','quantity','comment','discount');
    }

    public function showUnit(){
        return ($this->unit == 1)? '公斤': '公噸';
    }

    public function showStock(){
        if($this->unit == 2){
            return $this->stock / 1000;
        }
        return $this->stock;
    }

    public function Material_log(){
        return $this->hasMany(Material_logEloquent::class);
    }
}
