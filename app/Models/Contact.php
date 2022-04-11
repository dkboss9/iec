<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
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
            'address' => 'bail|required|string',
            'country' => 'required|in:aus,nep',
            'address2' => 'string|nullable',
            'email' => 'required|email|max:255|regex:/(.*)\.com/i',
            'email2' => 'nullable|email|max:255|regex:/(.*)\.com/i|unique:contacts,email',
            'phone' => 'required|digits:10',
            'phone1' => 'nullable|digits:10',
            'detail' => 'string|nullable',         
        ];
        if ($act != 'add'){
            $rule['email'] = "sometimes|email|max:255|regex:/(.*)\.com/i";
            $rule['email2'] = "sometimes|email|max:255|regex:/(.*)\.com/i";
        }
        return $rule;
    }
}
