<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;

class Contact extends Model
{
    protected $fillable = [
        'product_id', 'name', 'phone', 'gender','email', 'lineID', 'comment'
    ];

    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }

    // 顯示性別
    public function showGender(){
        return ($this->gender) ? "男" : "女";
    }
}
