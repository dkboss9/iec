<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $fillable = ['title','subtitle','image','added_by','updated_by'];
    protected $guarded = ['$id'];

    public function created_by()
    {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    
    public function parent_info()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }
    public function child_cats(){
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active');
    }
    public function getAllCategories(){
        return $this->where('status','active')
            ->where('parent_id',null)
            ->with('child_cats')
            ->orderBy('id','ASC')->limit(8)->get();
    }
    
    public function getChildCat($parent_id){
        return $this->where('parent_id', $parent_id)->where('status','active')->get();
    }
    public function shiftChild($child_id, $new_parent_id)
    {
        //UPDATE categories SET parent_id = 1 WHERE id IN (3,4,5)
        $this->whereIn('id', $child_id)->update(['parent_id' => $new_parent_id]);
    }

    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|required|string',
            'detail' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            // 'is_parent' => 'required_without:parent_id|boolean',
            // 'parent_id' => 'required_without:is_parent|exists:categories,id',       
        ];
        if ($act != 'add'){
            // $rule['title'] = "sometimes|string";
        return $rule;

        }
        return $rule;
    }
  
}
