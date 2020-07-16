<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Material_log as Material_logEloquent;
use App\ProduceDetail as ProduceDetailEloquent;
use App\ProductDetail as ProductDetailEloquent;
use App\Product as ProductEloquent;

class Material extends Model
{
    protected $fillable = [
        'name', 'shortName', 'comment', 'internationalNum', 'unit', 'unitPrice', 'stock', 'safeQuantity', 'picture',
    ];

    // 抓取此原物料 可以製成的 所有商品
    public function products(){
        return $this->belongsToMany(ProductEloquent::class, 'product_recipes')->withPivot('ratio', 'subcost');
    }

    public function purchaseOrders(){
        return $this->belongsToMany(PurchaseOrderEloquent::class)
            ->withPivot('price', 'totalPrice', 'quantity', 'comment', 'discount');
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

    public function showSafeQty(){
        if($this->unit == 2){
            return $this->safeQuantity / 1000;
        }
        return $this->safeQuantity;
    }

    public function material_log(){
        return $this->hasMany(Material_logEloquent::class);
    }

    public function ProduceDetail(){
        return $this->hasMany(ProduceDetailEloquent::class);
    }

    public function productDetail(){
        return $this->hasMany(ProductDetailEloquent::class);
    }
}
