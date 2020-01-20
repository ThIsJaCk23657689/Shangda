<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\PurchaseOrder as PurchaseOrderEloquent;
use App\Material_log as Material_logEloquent;
use App\JobTitle as JobTitleEloquent;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender'
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
    ];

    public function showGender(){
        return ($this->gender)? '男': '女';
    }

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrderEloquent::class);
    }

    public function Material_log(){
        return $this->hasMany(Material_logEloquent::class);
    }

    public function jobTitle(){
        return $this->belongsTo(JobTitleEloquent::class);
    }
}
