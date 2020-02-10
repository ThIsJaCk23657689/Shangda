<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicMaterial extends Model
{
    protected $fillable = ['name', 'price'];
    
    public $timestamps = false;
}
