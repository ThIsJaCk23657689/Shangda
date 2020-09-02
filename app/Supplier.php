<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrder as PurchaseOrderEloquent;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'shortName', 'taxId', 'tel', 'tax', 'comment',
        'operator_name_1', 'operator_tel_1', 'operator_email_1',
        'operator_name_2', 'operator_tel_2', 'operator_email_2',
        'companyAddress_zipcode', 'companyAddress_county',  'companyAddress_district', 'companyAddress_others',
        'bank_name', 'bank_branch_name', 'bank_code', 'bank_account', 'bank_account_name', 'monthlyCheckDate',
    ];

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrderEloquent::class);
    }

    public function showAddress(){
        return ($this->companyAddress_zipcode . $this->companyAddress_county . $this->companyAddress_district . $this->companyAddress_others) ?? '無';
    }
}
