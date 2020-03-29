<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Picture as PictureEloquent;
use App\SaleOrder as SaleOrderEloquent;
use App\Product as ProductEloquent;

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
