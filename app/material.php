<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'm_id';
    const UPDATED_AT = null;
    protected $fillable = [
        'material_name', 'stock'
    ];
}