<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $guarded = ['$id'];

    public function info_user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function  created_by(){
        return $this->hasOne('App\User','id','added_by');
    }
   
}
