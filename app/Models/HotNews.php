<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotNews extends Model
{
    protected $guarded= ['id'];

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
    public function rules(){
        return[
            'post_id' => 'nullable|exists:posts, id'
        ];
    }
}
