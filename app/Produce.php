<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;
use App\ProduceDetail as ProduceDetailEloquent;
use App\ProduceProduct as ProduceProductEloquent;
use App\User as UserEloquent;

class Produce extends Model
{
    protected $fillable = [
        'user_id', 'last_user_id'
    ];

    public function produceDetails(){
        return $this->hasMany(ProduceDetailEloquent::class);
    }

    // 紀錄這個 製程 可製作 哪些商品（多對多關係）
    public function products(){
        return $this->belongsToMany(ProductEloquent::class, 'produce_products');
    }

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    // 顯示最後更新者
    public function showLastUpdater(){
        $user = UserEloquent::find($this->last_user_id);
        if($user){
            return $user->name;
        }
        return '無';
    }
}
