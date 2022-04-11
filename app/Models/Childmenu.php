<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Childmenu extends Model
{
    protected $guarded = ['$id'];

    public function menu_info(){
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    }
    public function submenu_info(){
        return $this->belongsTo('App\Models\Submenu', 'submenu_id', 'id');
    }
    public function video_info(){
        return $this->hasOne('App\Models\Video', 'childmenu_id', 'id');
    }
    
    public function getchildmenus($submenu_id){
        return $this->where('status','active')->where('submenu_id', $submenu_id)->get();
    }
   
    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',
            'subtitle' => 'nullable|string',
            'detail' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'menu_id' => 'required|exists:menus,id',
            'submenu_id' => 'required|exists:submenus,id',
            'image' => 'nullable|image|max:5024'

        ];
        if ($act != 'add'){
            $rule['title'] = 'bail|required|string';
        }
        return $rule;
    } 
}
