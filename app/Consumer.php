<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SaleOrder as SaleOrderEloquent;

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
}
