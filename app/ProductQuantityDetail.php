<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Material as MaterialEloquent;
use App\ProductQuantity as ProductQuantityEloquent;
use App\Material_log as Material_logEloquent;


class ProductQuantityDetail extends Model
{
    protected $fillable = [
        'product_quantity_id', 'material_id', 'quantity', 
    ];

    public function productQuantity(){
        return $this->belongsTo(ProductQuantityEloquent::class);
    }

    public function material(){
        return $this->belongsTo(MaterialEloquent::class);
    }

    public function material_log(){
        return $this->hasMany(Material_logEloquent::class);
    }

}
