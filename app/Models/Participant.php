<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = ['id'];

    public function  program_info(){
        return $this->hasOne('App\Models\Program','id','program_id');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'name' => 'bail|required|string|max:256',
            'program_id'=>'required|exists:programs,id',
            'email' => 'required|email|unique:participants,email',
            'address' => 'required|string',
            'dob' => 'required|date',
            'phone' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'talent' => 'required|string',
            'status' => 'nullable|in:active,inactive',
            'image' => 'required|mimes:mimes:jpeg,png,jpg,gif,svg|max:5000',
            'identification' => 'required',
            'identification_type' => 'required|in:citizenship,license,passport,birth_certificate',
            'identification.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',            
            'video' =>'required|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts',   
        ];
        if ($act != 'add'){
            $rule['image'] = "sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120";
            $rule['identification'] = "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000";
            $rule['video'] = "sometimes"; 

        }
        return $rule;
    }
}
