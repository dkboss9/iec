<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
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
            'title' => 'bail|required|string',
            'subtitle' => 'string|nullable',
            'detail' => 'required|string', 
            'status' => 'nullable|in:active,inactive',
            'contributor_id' => 'nullable|exists:contributors,id',
            'author_id' => 'nullable|exists:authors,id',
            'image' => 'required|image|max:5120',           
        ];
        if ($act != 'add'){
            $rule['image'] = "sometimes|image|max:5120";
        }
        return $rule;
    }
}
