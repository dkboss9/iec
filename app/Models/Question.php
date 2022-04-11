<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['$id'];

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function option_info(){
        return $this->hasMany(Option::class,'question_id','id');
    }
    public function answer_info(){
        return $this->hasOne(Answer::class,'question_id','id');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'program' => 'required',
            'title' => 'bail|required|string',
            'option_text.*' => 'required|distinct|string',
            'point' => 'required|integer',
            'time_period' => 'required|integer',
            'status' => 'required|in:active,inactive',

        ];   
      
        return $rule;
    }

    public function updaterules($act = 'update'){
        $rule = [
            'title' => 'bail|required|string',
            'option_text.*' => 'required|distinct|string',
            'point' => 'required|integer',
            'status' => 'required|in:active,inactive',

        ];        
        return $rule;
    }
}
