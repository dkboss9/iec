<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $guarded = ['$id'];

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    
    public function participant_info(){
        return $this->hasMany(VotingOption::class,'voting_id','id');
    }
    public function Result_info(){
        return $this->hasMany(VotingResult::class,'voting_id','id');
    }
   
    public function rules($act = 'add'){
        $rule = [
            // 'program' => 'bail|required|string',
            // 'start' => 'required|date|after_or_equal:today',
            // 'end' => 'required|date|after:start',
            // 'status' => 'required|in:active,inactive',
            'name.*' => 'required|string',
            // 'name.distinct' => 'The option is required.',
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
            'participant.*' => 'required|distinct|string',
            'status' => 'required|in:active,inactive',

        ];        
        return $rule;
    }
}
