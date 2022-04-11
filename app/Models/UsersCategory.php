<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersCategory extends Model
{
    protected $guarded = ['id'];
    
    public function  cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function  menu_info(){
        return $this->hasOne('App\Models\Menu','id','menu_id');
    }
}

