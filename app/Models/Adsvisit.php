<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adsvisit extends Model
{
    protected $guarded = ['$id'];

    public function ads_info(){
        return $this->hasMany('App\Models\Advertise','ads_id','id');
    }
}
