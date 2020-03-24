<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Picture as PictureEloquent;
use App\SaleOrder as SaleOrderEloquent;
use App\Product as ProductEloquent;

class Consumer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'act', 'pwd', 'name', 'shortName', 'gender', 'idNumber', 'email', 'lineID',
        'monthlyCheckDate', 'uncheckedAmount', 'totalConsumption', 
        'address_zipcode', 'address_county', 'address_district', 'address_others',
        'policy_agreement', 'comment',

        'birthday', 'phone',

        'principal', 'taxID', 'tel', 'tax', 
        'operator_name', 'operator_tel', 'operator_email',
        'deliveryAddress_zipcode', 'deliveryAddress_county', 'deliveryAddress_district', 'deliveryAddress_others',
        
        'account_type', 'who_created', 'user_id'
    ];

    protected $hidden = [
        'pwd', 'remember_token',
    ];

    public function saleOrder(){
        return $this->hasMany(SaleOrderEloquent::class);
    }

    // 抓取此顧客有優惠的商品
    public function products(){
        return $this->belongsToMany(ProductEloquent::class, 'discounts')->withPivot('price');
    }

    // 抓取此顧客的圖片 多型一對一關聯 (一個顧客對應一張照片)
    public function picture(){
        return $this->morphOne(PictureEloquent::class, 'pictureable');
    }
    
    // 顯示顧客頭貼
    public function showPicture(){
        $picture = $this->picture;

        if(empty($picture->url)){
            return URL::asset('images/consumers/default.png');
        }else{
            if(!preg_match("/^[a-zA-Z]+:\/\//", $picture->url)){
                return URL::asset($picture->url);
            }else{
                return $picture->url;
            }
        }
    }
}
