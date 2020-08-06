<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Picture as PictureEloquent;
use App\SalesOrder as SalesOrderEloquent;
use App\Product as ProductEloquent;
use URL;

class Consumer extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'account', 'password', 'name', 'shortName', 'gender', 'idNumber', 'email', 'lineID',
        'monthlyCheckDate', 'uncheckedAmount', 'totalConsumption',
        'address_zipcode', 'address_county', 'address_district', 'address_others',
        'policy_agreement', 'comment',

        'birthday', 'phone',

        'branch', 'principal', 'taxID', 'tel', 'tax',
        'operator_name', 'operator_tel', 'operator_email',
        'deliveryAddress_zipcode', 'deliveryAddress_county', 'deliveryAddress_district', 'deliveryAddress_others',

        'account_type', 'who_created', 'user_id'
    ];

    protected $hidden = [
        'pwd', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function saleOrder(){
        return $this->hasMany(SalesOrderEloquent::class);
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

    // 顯示地址
    public function showAddress(){
        return ($this->address_zipcode . $this->address_county . $this->address_district . $this->address_others)=="" ? '無' : ($this->address_zipcode . $this->address_county . $this->address_district . $this->address_others);
    }
    // 顯示送貨地址
    public function showDeliveryAddress(){
        return ($this->deliveryAddress_zipcode . $this->deliveryAddress_county . $this->deliveryAddress_district . $this->deliveryAddress_others)=="" ? '無' : ($this->deliveryAddress_zipcode . $this->deliveryAddress_county . $this->deliveryAddress_district . $this->deliveryAddress_others);
    }

    // 顯示性別
    public function showGender(){
        return ($this->gender) ? "男" : "女";
    }
}
