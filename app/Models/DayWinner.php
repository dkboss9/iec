<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayWinner extends Model
{
    protected $guarded = ['id'];
    
    public function created_by() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function question_info(){
        return $this->belongsTo(Question::class,'question_id');
    }
    
}
