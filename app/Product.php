<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'shortName', 'fundamentalPrice', 'retailPrice', 
        'materialCoefficient1', 'materialCoefficient2', 'materialCoefficient3',
        'materialCoefficient4', 'materialCoefficient5', 
        
        'comment', 'internationalNum', 'unit', 'quantity', 'safeQuantity',
        'picture', 'intro', 'specification',
    ];
}
