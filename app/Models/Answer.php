<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = ['$id'];

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }  
    public function question_info(){
        return $this->belongsTo(Question::class,'question_id');
    }
    public function answer_info(){
        return $this->belongsTo(Option::class,'option_id');
    }

    public function rules($act = 'add'){
        $rule = [
            'option_id' => 'required|exists:options,id',
            'question_id' => 'required|exists:questions,id',
        ];
        if($act != 'add'){
            
        }
        return $rule;
    }
}
