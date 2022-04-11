<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = ['id'];

    public function  created_by(){
        return $this->hasOne('App\User','id','added_by');
    }

    public function rules($act = 'add'){
        $rule = [
            'name' => 'bail|required|string',
            'detail' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|max:5120',   
        ];
        if ($act != 'add'){
            $rule['image'] = 'sometimes|image|max:5120';
        }
        return $rule;
    }
   
}
