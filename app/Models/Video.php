<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use \Conner\Tagging\Taggable;

    protected $guarded = ['$id'];

    public function  created_by(){
        return $this->hasOne('App\User','id','added_by');
    }
    public function menu_info(){
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    }
    public function submenu_info(){
        return $this->belongsTo('App\Models\Submenu', 'submenu_id', 'id');
    }
    public function childmenu_info(){
        return $this->belongsTo('App\Models\Childmenu', 'childmenu_id', 'id');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',
            'tags' => 'sometimes',          
            'status' => 'nullable|in:active,inactive',
            'menu_id' => 'required|exists:menus,id',
            'submenu_id' => 'required|exists:submenus,id',
            'childmenu_id' => 'nullable|exists:childmenus,id',
            'subtitle' => 'string|nullable',
            'detail' => 'string|nullable', 
            'is_trending' => 'sometimes|in:1,0',
            'link'  => ['nullable','url','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'video'  => 'required_without:link|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10000',
            // 'link' => 'nullable|url|',
            // 'video' =>'required_if:link,null|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10000|nullable',
            'image' => 'required|image|max:5000',
            'date' => 'nullable|date',

        ];
        if ($act != 'add'){
            $rule['link'] = ['sometimes','url','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'];
          	$rule['video'] = 'sometimes|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10000';
            $rule['image'] = 'sometimes|image|max:5000';
            $rule['tags'] = 'sometimes';
        }
        return $rule;
    }
}