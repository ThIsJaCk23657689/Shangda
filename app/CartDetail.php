<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CartOrder as CartEloquent;

class CartDetail extends Model
{
    protected $fillable = [
        'cart_id', 'product_id', 'price', 'count','quantity', 'discount',
        'subTotal', 'comment'
    ];

    public $timestamps = false;

    public function cart(){
        return $this->belongsTo(CartEloquent::class);
    }
}
