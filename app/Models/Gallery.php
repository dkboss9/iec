<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = ['$id'];

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',                 
            'image' => 'required|image|max:5120',  
            'status' => 'nullable|in:active,inactive',

        ];
        if ($act != 'add'){
            $rule['image'] = "sometimes|image|max:5120";
        }
        return $rule;
    }
}
