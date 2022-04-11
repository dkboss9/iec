<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function  cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function  sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','sub_cat_id');
    }
    public function  created_by(){
        return $this->hasOne('App\User','id','added_by');
    }
    public function author_info()
    {
        return $this->hasOne('App\Models\Author', 'id', 'author_id');
    }
    public function contributor_info()
    {
        return $this->hasOne('App\Models\Contributor', 'id', 'contributor_id');
    }
    public function  images(){
        return $this->hasMany('App\Models\Post_image','post_id','id');
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review','post_id','id');
    }

    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',
            'subtitle' => 'nullable|string',
            'detail' => 'nullable|string',
            'cat_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:categories,id',
            'contributor_id' => 'nullable|exists:contributors,id',
            'author_id' => 'nullable|exists:authors,id',
            'status' => 'nullable|in:active,inactive',
            'is_trending' => 'sometimes|in:1,0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            // 'link' => 'nullable|url',
            'date' => 'nullable|date',
            'video' =>'nullable|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10240',   
        ];
        if ($act != 'add'){
            $rule['image'] = "sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120";
            $rule['video'] = "sometimes|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10240"; 

        }
        return $rule;
    }
   
}
