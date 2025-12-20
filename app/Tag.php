<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * 取得擁有此標籤的所有商品
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }
}
