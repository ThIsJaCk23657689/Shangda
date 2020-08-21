<?php

namespace App;

// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use App\Picture as PictureEloquent;
use App\SalesOrder as SalesOrderEloquent;
use App\Product as ProductEloquent;
use App\Cart as CartEloquent;
use Lang;
use URL;

class Consumer extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guard = 'consumer';

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
        'password', 'remember_token',
    ];

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

    // 購物車
    public function cart(){
        return $this->hasOne(CartEloquent::class);
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

    public function sendPasswordResetNotification($token)
    {
        $notification = new ResetPassword($token);
        $notification::toMailUsing(function(Consumer $notifiable, string $token){
            
            return (new MailMessage())
                ->subject(Lang::get('Reset Password Notification'))
                ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
                ->action(Lang::get('Reset Password'), url(route('consumers.password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
                ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.consumers.expire')]))
                ->line(Lang::get('If you did not request a password reset, no further action is required.'));
        });

        $this->notify($notification);
    }
}
