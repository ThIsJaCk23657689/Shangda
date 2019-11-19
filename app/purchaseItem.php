<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseItem extends Model
{
    protected $table = 'purchase_items';
    protected $primaryKey = 'pi_id';
    const UPDATED_AT = null;
    protected $fillable = [
        'm_id', 'po_id', 'count', 'price', 'discount','total_price','remark'
    ];
}
