<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = ['$id'];

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by() {
        return $this->hasOne('App\User', 'poll_id', 'updated_by');
    }
    public function vote_info(){
        return $this->hasMany(Vote::class,'poll_id','id');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
            'vote.*' => 'required|distinct|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:5120',   

        ];   
        if ($act != 'add') {
            # code...
        }     
        return $rule;
    }

    public function updaterules($act = 'update'){
        $rule = [
            'title' => 'bail|required|string',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
            'vote.*' => 'required|distinct|string',
            'status' => 'required|in:active,inactive',

        ];        
        return $rule;
    }
}
