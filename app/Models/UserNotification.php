<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $guarded = ['$id'];

    public function getRules($act = 'add'){
        $rule = [
            'title' => 'required_without_all:description',
            'description' => 'required_without_all:title',
        ];
        if ($act != 'add'){
           
        }
        return $rule;
    } 
}
