<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobTitle as JobTitleEloquent;

class Notification extends Model
{
    protected $fillable = [
        'job_title_id', 'type', 'status', 'comment'
    ];

    public function jobTitle(){
        return $this->belongsTo(JobTitleEloquent::class);
    }
}
