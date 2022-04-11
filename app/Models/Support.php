<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $guarded = ['id'];

    public function rules(){
        $rule = [
            'email' => 'bail|required|email|regex:/(.*)\.com/i',
            'name' => ['required', 'string', 'max:255'],
            'comment' => 'string|required|',
            'phone' => 'string|nullable|digits:10',
        ];
        return $rule;
    }
}
