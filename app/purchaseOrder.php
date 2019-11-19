<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseOrder extends Model
{
    protected $table = 'purchase_orders';
    protected $primaryKey = 'po_id';
    const UPDATED_AT = null;
    protected $fillable = [
        's_id', 'purchaser', 'purchaser_tel', 'purchaser_fax',
        'delivery_time', 'delivery_place', 'payment_type', 'remark'
    ];

    public function purchase_items()
    {
        return $this->hasMany(purchaseItem::class, 'po_id');
    }
}
