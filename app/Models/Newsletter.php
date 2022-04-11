<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $guarded = ['$id'];

    public function rules($act = 'add'){
        $rule = [
            'title' => 'bail|string|required',
            'message' => 'string|required',
            'attachment' => 'nullable|file|max: 5120',
            // 'schedule_date' => 'nullable|string',
        ];
        if ($act != 'add'){
            $rule['title'] = 'sometimes|string';
        }
        return $rule;
    } 
}
