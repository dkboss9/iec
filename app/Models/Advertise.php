<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $guarded = ['id'];

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function adsvisit()
    {
        return $this->belongsTo('App\Models\Adsvisit', 'id', 'ads_id');
    }
    

    public function Rule($act = 'add'){
        $rules = [
            'title' => 'bail|required|string',
            'position' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
            // 'image' => 'required|image|max:5120',
            'image' =>'required|mimes:,jpg,jpeg,gif,png,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10000',
            'type' => 'required|in:image,video',
            'link_type' => 'required|in:internal,external',
        ];
        if ($act != 'add'){
            $rules['image'] = "sometimes|mimes:,jpg,jpeg,gif,png,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10000";
        }
        return $rules;
    }
}
