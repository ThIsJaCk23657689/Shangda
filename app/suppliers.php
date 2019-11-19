<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 's_id';
    const UPDATED_AT = null;
    protected $fillable = [
        'supplier_name', 'contact_person', 'tel', 'fax', 'address'
    ];
}