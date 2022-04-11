<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $guarded= ['id'];

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function Rules(){
        $rule = [            
            'title' => 'bail|string|required',
            'message' => 'string|required',
        ];
        return $rule;
    }
}
