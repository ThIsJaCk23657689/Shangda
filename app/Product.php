<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category as CategoryEloquent;
use App\Produce as ProduceEloquent;
use App\ProductLog as ProductLogEloquent;
use App\ProductDetail as ProductDetailEloquent;
use App\Material as MaterialEloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use URL;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'shownID', 'isManualID', 'name', 'isManualNamed', 
        'internationalNum', 'picture', 'specification', 'color', 
        'isCustomize', 'isPublic', 'showPrice',
        'length' ,'width', 'chamfer', 'weight', 'qty_per_pack',
        'unit', 'intro', 'quantity', 'safeQuantity', 'comment',

        'costprice', 'profit', 'retailPrice',
    ];

    protected $casts = [
        'isManualID' => 'boolean',
        'isManualNamed' => 'boolean',
        'isCustomize' => 'boolean',
    ];

    // 抓取此商品的所有成分(原物料)
    public function materials(){
        return $this->belongsToMany(MaterialEloquent::class, 'product_recipes')->withPivot('ratio', 'subcost');
    }

    public function category(){
        return $this->belongsTo(CategoryEloquent::class);
    }

    public function produce(){
        return $this->hasMany(ProduceEloquent::class);
    }

    public function productlogs(){
        return $this->hasMany(ProductLogEloquent::class);
    }

    public function productDetails(){
        return $this->hasMany(ProductDetailEloquent::class);
    }

    public function showUnit(){
        switch($this->unit){
            case "package":
                $result = "包";
                break;
            case "kg":
                $result = "公斤";
                break;
            case "roll":
                $result = "捲";
                break;
            default:
                $result = "個";
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
