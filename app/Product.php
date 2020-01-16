<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'shortName', 'fundamentalPrice', 'retailPrice', 
        'materialCoefficient1', 'materialCoefficient2', 'materialCoefficient3',
        'materialCoefficient4', 'materialCoefficient5', 
        
        'comment', 'internationalNum', 'unit', 'quantity', 'safeQuantity',
        'picture', 'intro', 'specification',
    ];

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
}
