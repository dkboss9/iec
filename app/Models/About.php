<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
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
            'subtitle' => 'string|nullable',
            'detail' => 'string|nullable',            
            'image' => 'required|image|max:5120',           
        ];
        if ($act != 'add'){
            $rule['image'] = "sometimes|image|max:5120";
        }
        return $rule;
    }
}
