<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['$id'];

    public function submenu_info(){
        return $this->hasMany('App\Models\Submenu','menu_id','id');
    }
    public function childmenu_info(){
        return $this->hasMany('App\Models\Childmenu','menu_id','id');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|string|required',
            'status' => 'required|in:active,inactive',
        ];
        if ($act != 'add'){
        }
        return $rule;
    } 
}
