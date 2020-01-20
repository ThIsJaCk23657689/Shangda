<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;
use App\Material as MaterialEloquent;

class ProductQuantity extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 
    ];

    public function products(){
        return $this->belongsTo(ProductEloquent::class);
    }

    public function materials(){
        return $this->belongsToMany(MaterialEloquent::class, 'product_quantity_details', 'product_quantity_id', 'material_id')
            ->withPivot('quantity');
    }
}
