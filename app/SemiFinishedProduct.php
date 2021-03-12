<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemiFinishedProduct extends Model
{
    protected $fillable = [
        'shownID', 'name', 'unit', 'comment', 'stock', 'safeQuantity', 'picture', 'costPrice', 
    ];

    // 抓取此半成品的所有成分(原物料)
    public function materials(){
        return $this->belongsToMany(MaterialEloquent::class, 'product_recipes')->withPivot('ratio', 'subcost');
    }

    public function showUnit(){
        switch($this->unit){
            case "1":
                $result = "公斤";
                break;
            case "2":
                $result = "臺兩";
                break;
            case "3":
                $result = "鎊";
                break;
            default:
                $result = "未知狀況";
        }
        return $result;
    }
}
