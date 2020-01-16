<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'intro'];
    public $timestamps = false;

    public function products(){
        return $this->hasmany(ProductEloquent::class);
    }
}
