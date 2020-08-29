<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Information extends Model
{
    protected $fillable = [
        'cover_image'
    ];

    public function showCoverImage(){
        if(empty($this->cover_image)){
            return URL::asset('images/background/welcome.jpg');
        }else{
            return URL::asset($this->cover_image);
        }
    }
}
