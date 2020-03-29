<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'url', 'index', 'pictureable_id', 'pictureable_type'
    ];

    public function pictureable(){
        return $this->morphTo();
    }
}
