<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProduceDetail as ProduceDetailEloquent;
use App\ProduceProduct as ProduceProductEloquent;
use App\User as UserEloquent;

class Produce extends Model
{
    protected $fillable = [
        'user_id', 'last_user_id'
    ];


    public function produceDetails(){
        return $this->hasMany(ProduceDetailEloquent::class);
    }

    public function produceProducts(){
        return $this->hasMany(ProduceProductEloquent::class);
    }

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }
}
