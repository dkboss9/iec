<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $guarded = ['$id'];

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'user_id');
    } 
    public function poll_info(){
        return $this->belongsTo(Poll::class,'poll_id');
    }
    public function vote_info(){
        return $this->belongsTo(Vote::class,'vote_id');
    }
}
