<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $guarded = ['id'];
     
    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function post_info()
    {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
    public function blog_info()
    {
        return $this->hasOne('App\Models\Blog', 'id', 'blog_id');
    }
    public function video_info()
    {
        return $this->hasOne('App\Models\Video', 'id', 'video_id');
    }
    public function rules(){
        return[
            'post_id' => 'nullable|exists:posts, id',
            'blog_id' => 'nullable|exists:blogs, id',
            'video_id' => 'nullable|exists:videos, id',
        ];
    }
}
