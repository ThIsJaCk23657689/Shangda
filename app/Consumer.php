<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\SaleOrder as SaleOrderEloquent;
use App\Product as ProductEloquent;

class Consumer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shownID', 'name', 'act', 'pwd', 'taxID', 'idNumber', 'inCharge1', 'tel1',
        'email1', 'inCharge2', 'tel2', 'email2', 'tax', 'monthlyCheckDate', 'uncheckedAmount',
        'totalConsumption', 'companyAddress', 'deliveryAddress', 'invoiceAddress', 'comment',
        'account_type',  'user_id'
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
}
