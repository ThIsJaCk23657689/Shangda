<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as UserEloquent;
use URL;

class Announcement extends Model
{
    protected $fillable = [
        'last_update_user_id', 'title', 'content', 'cover_image'
    ];

    public function user(){
        return $this->belongsTo(UserEloquent::class, 'last_update_user_id');
    }

    public function showCoverImage(){
        if(empty($this->cover_image)){
            return URL::asset('images/announcements/cover_images/default.jpg');
        }else{
            return URL::asset($this->cover_image);
        }
    }
}
