<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];
    public function post_info()
    {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
}
