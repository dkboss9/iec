<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
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
            'image' => 'image|max:5120',  
            'status' => 'nullable|in:active,inactive',

        ];
      
        return $rule;
    }
}
