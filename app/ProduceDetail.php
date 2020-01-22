<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Material as MaterialEloquent;
use App\Produce as ProduceEloquent;
use App\MaterialLog as MaterialLogEloquent;

class ProduceDetail extends Model
{
    protected $fillable = [
        'produce_id', 'material_id', 'quantity', 
    ];

    public function Produce(){
        return $this->belongsTo(ProduceEloquent::class);
    }

    public function material(){
        return $this->belongsTo(MaterialEloquent::class);
    }

    public function materialLog(){
        return $this->hasMany(MaterialLogEloquent::class);
    }
}
