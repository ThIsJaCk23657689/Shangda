<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Picture as PictureEloquent;
use App\Material as MaterialEloquent;
use App\Category as CategoryEloquent;
use App\Produce as ProduceEloquent;
use App\ProductLog as ProductLogEloquent;
use App\Consumer as ConsumerEloquent;
use App\Contact as ContactEloquent;

use URL;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'shownID', 'isManualID', 'name', 'isManualNamed',
        'internationalNum', 'specification', 'color',
        'isCustomize', 'isPublic', 'showPrice',
        'length' ,'width', 'chamfer', 'weight', 'qty_per_pack',
        'unit', 'intro', 'quantity', 'safeQuantity', 'comment',

        'costprice', 'profit', 'retailPrice',
    ];

    protected $casts = [
        'isManualID' => 'boolean',
        'isManualNamed' => 'boolean',
        'isCustomize' => 'boolean',
        'showPrice' => 'boolean',
    ];

    // 抓取此商品的圖片() 多型一對多關聯 (系統設定一個商品最多就5張圖片)
    public function pictures(){
        return $this->morphMany(PictureEloquent::class, 'pictureable');
    }

    // 抓取此商品的所有成分(原物料)
    public function materials(){
        return $this->belongsToMany(MaterialEloquent::class, 'product_recipes')->withPivot('ratio', 'subcost');
    }

    // 抓取擁有此商品優貨的顧客們
    public function consumers(){
        return $this->belongsToMany(ConsumerEloquent::class, 'discounts')->withPivot('price');
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

    public function contacts(){
        return $this->hasMany(ContactEloquent::class);
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

    public function showPicture($index = 1){
        $picture = $this->pictures()->where('index', '=', $index)->first();
        if(!$picture){
            return URL::asset('images/products/default.png');
        }else{
            if(empty($picture->url)){
                return URL::asset('images/products/default.png');
            }else{
                if(!preg_match("/^[a-zA-Z]+:\/\//", $picture->url)){
                    return URL::asset($picture->url);
                }else{
                    return $picture->url;
                }
            }
        }

    }
}
