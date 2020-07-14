<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produce as ProduceEloquent;
use App\Product as ProductEloquent;
use App\ProductLog as ProductLogEloquent;

class ProduceProduct extends Model
{
    protected $fillable = [
        'produce_id', 'product_id', 'quantity',
    ];

    public $timestamps = false;

    public function produce(){
        return $this->belongsTo(ProduceEloquent::class);
    }

    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }

}
