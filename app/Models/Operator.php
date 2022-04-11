<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $guarded = ['id'];

    public function  created_by(){
        return $this->hasOne('App\User','id','added_by');
    }
    public function cat_info(){
        return $this->hasMany('App\Models\UsersCategory','operator_id','id');
    }
    public function info_user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = json_encode($value);
    }
    public function getCategoryAttribute($value)
    {
        return $this->attributes['category'] = json_decode($value);
    }

    public function setMenuAttribute($value)
    {
        $this->attributes['menu'] = json_encode($value);
    }
    public function getMenuAttribute($value)
    {
        return $this->attributes['menu'] = json_decode($value);
    }

    public function Rules($act = 'add'){
        $rule = [
            'name' => ['bail','required', 'string', 'max:255'],
            'email' => 'required|unique:users,email|regex:/(.*)\.com/i',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'citizenship' => 'required|string',
            'is_verified' => 'nullable|in:1,0',
            'category' => 'required_without_all:blog,menu,gallery,adver',
            'menu' => 'required_without_all:category,blog,gallery,adver',
            'blog' => 'required_without_all:category,menu,gallery,adver|in:1,0',
            'gallery' => 'required_without_all:category,menu,blog,adver|in:1,0',
            'adver' => 'required_without_all:category,menu,blog,gallery|in:1,0',
            'address' => 'nullable|string',
            'other_id' => 'nullable|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'detail' => 'nullable|string', 
        ];
        return $rule;
    }
    public function updateRule($act = 'update'){
        $rule = [
            'name' => ['bail','required', 'string', 'max:255'],
            'email' => 'sometimes|regex:/(.*)\.com/i',
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'citizenship' => 'required|string',
            'is_verified' => 'nullable|in:1,0',
            'category' => 'required_without_all:blog,menu,gallery,adver',
            'menu' => 'required_without_all:category,blog,gallery,adver',
            'blog' => 'required_without_all:category,menu,gallery,adver|in:1,0',
            'gallery' => 'required_without_all:category,menu,blog,adver|in:1,0',
            'adver' => 'required_without_all:category,menu,blog,gallery|in:1,0',
            'address' => 'nullable|string',
            'other_id' => 'nullable|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'detail' => 'nullable|string', 
        ];
        return $rule;
    }
}
