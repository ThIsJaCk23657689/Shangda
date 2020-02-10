<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category as CategoryEloquent;
use App\Produce as ProduceEloquent;
use App\ProductLog as ProductLogEloquent;
use App\ProductDetail as ProductDetailEloquent;
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

    public function produce(){
        return $this->hasMany(ProduceEloquent::class);
    }

    public function category(){
        return $this->belongsTo(CategoryEloquent::class);
    }

    public function productlogs(){
        return $this->hasMany(ProductLogEloquent::class);
    }

    public function productDetails(){
        return $this->hasMany(ProductDetailEloquent::class);
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

    public function nameDivide(){
        $array = explode("/",$this->name);
        $specification_arr = explode("(",$array[0]);
        $specification = $specification_arr[1];
        $name = $specification_arr[0];

        $weight_arr =  explode(")",$array[2]);
        $weight = $weight_arr[0];

        $result = [];
        $result['name'] = $name;
        $result['specification'] = $specification;
        $result['size'] = $array[1];
        $result['weight'] = $weight;
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
