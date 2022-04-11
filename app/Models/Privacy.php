<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    protected $guarded = ['id'];

    public function rules(){
        $rule = [
            'title' => ['bail','required', 'string', 'max:255'],
            'detail' => 'required|string',
        ];
        return $rule;
    }
}
