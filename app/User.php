<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Material_log as Material_logEloquent;
use App\Product_log as Product_logEloquent;
use App\JobTitle as JobTitleEloquent;
use App\ProductQuantity as ProductQuantityEloquent;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'account', 'password', 'gender', 'birthday', 'tel', 'phone',
        'address_zipcode', 'address_county', 'address_district', 'address_others', 'comment', 'job_title_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'datetime:Y-m-d',
    ];  

    public function showGender(){
        return ($this->gender)? '男': '女';
    }

    public function showAge(){
        if($this->birthday != null){
            return Carbon::parse($this->birthday)->age . ' 歲';
        }
        return '無';
    }

    public function showBirthday(){
        if($this->birthday != null){
            return $this->birthday->toDateString();
        }
        return null;
    }

    public function showAddress(){
        $result = $this->address_zipcode . $this->address_county . $this->address_district . $this->address_others;
        if(is_null($result) || $result == ''){
            return '無資料';
        }
        return $result;
    }

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrderEloquent::class);
    }
    
    public function productQuantityEloquentOrders(){
        return $this->hasMany(ProductQuantityEloquent::class);
    }

    public function material_log(){
        return $this->hasMany(Material_logEloquent::class);
    }

    public function product_log(){
        return $this->hasMany(Product_logEloquent::class);
    }

    public function jobTitle(){
        return $this->belongsTo(JobTitleEloquent::class);
    }
}
