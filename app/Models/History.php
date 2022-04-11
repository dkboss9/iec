<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = ['id'];

    public function  post_info(){
        return $this->hasOne('App\Models\Post','id','post_id');
    }
    public function  video_info(){
        return $this->hasOne('App\Models\Video','id','video_id');
    }
}
