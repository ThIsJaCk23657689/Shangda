<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;
use App\ProduceDetail as ProduceDetailEloquent;
use App\ProductLog as ProductLogEloquent;
use App\User as UserEloquent;

class Produce extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'user_id', 'last_user_id'
    ];

    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }

    public function produceDetails(){
        return $this->hasMany(ProduceDetailEloquent::class);
    }

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }
}
