<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $guarded = ['id'];

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    
    public function participant_info(){
        return $this->hasMany('App\Models\Participant','program_id','id');
    }

    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',
            'detail' => 'nullable|string',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
            'status' => 'nullable|in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
        if ($act != 'add'){
            $rule['start']= "sometimes|date";
            $rule['end']= "sometimes|date|after:start";
            $rule['image'] = "sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120";
            // $rule['video'] = "sometimes|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10240"; 

        }
        return $rule;
    }
}
