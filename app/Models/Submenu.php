<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $guarded = ['$id'];

    public function menu_info(){
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    }
    public function childmenu_info(){
        return $this->hasOne('App\Models\Childmenu', 'childmenu_id', 'id');
    }
    public function video_info(){
        return $this->hasMany('App\Models\Video', 'submenu_id', 'id');
    }
    
    public function getsubmenus($menu_id){
        return $this->where('status','active')->where('menu_id', $menu_id)->get();
    }
   
    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',
            'subtitle' => 'string|nullable',
            'detail' => 'nullable|string',
            'menu_id' => 'required|exists:menus,id',
            'status' => 'required|in:active,inactive',
        ];
        if ($act != 'add'){
        }
        return $rule;
    } 
}
