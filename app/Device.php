<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = ['id'];
    
    public function cat_info(){
        return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }
    public function post_info(){
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
    public function video_info(){
        return $this->hasOne('App\Models\Video', 'id', 'video_id');
    }
    public function mass_info(){
        return $this->hasOne('App\Models\UserNotification', 'id', 'mass_id');
    }
    public function voter_info(){
        return $this->hasOne('App\Models\Poll', 'id', 'voter_id');
    }
    public function quiz_info(){
        return $this->hasOne('App\Models\Result', 'id', 'quiz_id');
    }
   
}
