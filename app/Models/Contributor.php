<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    // protected $fillable = ['title', 'description', 'file_path', 'client_id', 'cat_id', 'status','added_by','updated_by'];
    protected $guarded = ['$id'];

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
    public function modify_by()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
   
    public function rules($act = 'add'){
        $rule = [
            'name' => 'bail|required|string',
            'email' => 'required|email|regex:/(.*)\.com/i',
            'address' => 'string|nullable',
            'phone' => 'nullable|digits:10',
            'detail' => 'string|nullable',            
            'image' => 'required|image|max:5120',           
        ];
        if ($act != 'add'){
            $rule['image'] = "sometimes|image|max:5120";
        }
        return $rule;
    }
}
