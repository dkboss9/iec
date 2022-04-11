<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quizprogram extends Model
{
    protected $guarded = ['$id'];
    protected $table = 'quiz_programs';

    public function created_by() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }

    public function rules($act = 'add'){
        $rule = [
            'name' => 'bail|required|string',
            'detail' => 'nullable|string',
            'program_time' => 'required|date|after_or_equal:today',
            'status' => 'nullable|in:active,inactive',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
        if ($act != 'add'){
            $rule['program_time']= "sometimes|date";
            $rule['image'] = "sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120";
            // $rule['video'] = "sometimes|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:10240"; 

        }

        if($_POST['is_free'] == 'No'){
            $rule['price']= "required|min:1";
        }
        return $rule;
    }

    // public function question_info(){
    //     return $this->belongsTo(Question::class,'question_id');
    // }
    // public function answer_info(){
    //     return $this->belongsTo(Option::class,'option_id');
    // }
}
