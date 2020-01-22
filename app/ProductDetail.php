<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;
use App\Material as MaterialEloquent;

class ProductDetail extends Model
{
    protected $fillable = [
        'produce_id', 'material_id'
    ];
    
    public $timestamps = false;

    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }

    public function material(){
        return $this->belongsTo(MaterialEloquent::class);
    }
}
