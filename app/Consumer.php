<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    protected $fillable = [
         'name', 'shortName', 'act', 'taxID', 'idNumber', 'inCharge1', 'tel1',
        'email1', 'inCharge2', 'tel2', 'email2', 'tax', 'monthlyCheckDate', 'uncheckedAmount',
        'totalConsumption', 'companyAddress', 'deliveryAddress', 'invoiceAddress', 'comment',
    ];

    protected $hidden = [
        'pwd', 'remember_token',
    ];
}
