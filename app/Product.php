<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category as CategoryEloquent;
use App\ProductQuantity as ProductQuantityEloquent;
use App\Product_log as ProductLogEloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use URL;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'name', 'shortName', 'fundamentalPrice', 'retailPrice',
        'materialCoefficient1', 'materialCoefficient2', 'materialCoefficient3',
        'materialCoefficient4', 'materialCoefficient5',

        'comment', 'internationalNum', 'unit', 'quantity', 'safeQuantity',
        'picture', 'intro', 'specification',
    ];

    public function productQuantities(){
        return $this->hasMany(ProductQuantityEloquent::class);
    }

    public function category(){
        return $this->belongsTo(CategoryEloquent::class);
    }

    public function product_log(){
        return $this->hasMany(ProductLogEloquent::class);
    }

    public function showUnit(){
        switch($this->unit){
            case "g":
                $result = "公克";
                break;
            case "kg":
                $result = "公斤";
                break;
            case "mt":
                $result = "公噸";
                break;
        }
        return $result;
    }

    public function showPicture(){
        if(empty($this->picture)){
            return URL::asset('images/products/default.png');
        }else{
            if(!preg_match("/^[a-zA-Z]+:\/\//", $this->picture)){
                return URL::asset($this->picture);
            }else{
                return $this->picture;
            }
        }
    }
}
