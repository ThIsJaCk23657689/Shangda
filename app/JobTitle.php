<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as UserEloquent;

class JobTitle extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function users(){
        return $this->hasMany(UserEloquent::class);
    }

    public function usersWithTrashed(){
        return $this->hasMany(UserEloquent::class)->withTrashed()->get();
    }
}
