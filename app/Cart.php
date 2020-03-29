<?php

namespace App;

use App\Product as ProductEloquent;
use App\Consumer as ConsumerEloquent;
use App\CartDetail as CartEloquent;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'consumer_id', 'totalTaxPrice', 'comment'
    ];

    public function consumer(){
        return $this->belongsTo(ConsumerEloquent::class);
    }

    public function products(){
        return $this->belongsToMany(ProductEloquent::class)
        ->withPivot('price', 'quantity', 'subTotal', 'comment', 'discount');
    }

    public function details(){
        return $this->hasMany(CartEloquent::class);
    }
}
