<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;
use App\ProductQuantityDetail as ProductQuantityDetailEloquent;
use App\Product_log as Product_logEloquent;
use App\User as UserEloquent;

class ProductQuantity extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'user_id', 'last_user_id'
    ];

    public function products(){
        return $this->belongsTo(ProductEloquent::class);
    }

    public function productQuantityDetail(){
        return $this->hasMany(ProductQuantityDetailEloquent::class);
    }

    public function product_log(){
        return $this->hasMany(Product_logEloquent::class);
    }

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }
}
