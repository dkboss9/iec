<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = ['$id'];

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function author_info()
    {
        return $this->hasOne('App\Models\Author', 'id', 'author_id');
    }
    public function contributor_info()
    {
        return $this->hasOne('App\Models\Contributor', 'id', 'contributor_id');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|string|required',
            'subtitle' => 'string|nullable',
            'detail' => 'string|nullable',            
            'link' => 'nullable|url',
            'video' =>'nullable|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10000',
        ];
        if ($act != 'add'){
            $rule['title'] = 'sometimes|string';
        }
        return $rule;
    }   
}
