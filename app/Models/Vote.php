<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = ['$id'];

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }  
    public function poll_info(){
        return $this->belongsTo(Poll::class,'poll_id');
    }
   
}
