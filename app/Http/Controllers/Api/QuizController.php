<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Question;
use App\Models\Option;
use App\Models\Answer;
use App\Models\QuizAnswer;
use App\Models\Result;

use Auth;
use Session;
use Validation;
use File;
use Mail;
use App\User;
use JWTAuth;
use Carbon\Carbon;

use App\Device;

class QuizController extends Controller
{
    public function getquestion()
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user

            $total_quiz = Result::where('added_by',auth('api')->user()->id)->get();
            $q = Result::where('added_by',auth('api')->user()->id)->pluck('question_id')->toArray();
            $s = Result::where('added_by',auth('api')->user()->id)->pluck('point')->toArray();
            $l = Result::where('added_by',auth('api')->user()->id)->latest()->first();
            if (empty($l)) {
                $l['created_at'] = '';
            }
            
            $total_reward = array_sum($s);

            $question = Question::whereNotIn('id',$q)->whereStatus('active')->with('option_info')->orderBy('id','asc')->first();
            if (!empty($question)) {
                $r = Answer::where('question_id', $question->id)->first();
                $question->answer = $r->option_id;
            }
            return response()->json([
                'total_quiz'=> $total_quiz->count(),
                'total_reward'=> $total_reward,
                'last_quiz' => $l,
                'question'=> $question,
            ]);

        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
        
    }

    public function quizAnswer(Request $request)
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user
            $b = QuizAnswer::where('added_by',auth('api')->user()->id)->where('question_id',$request->question_id)->get();
            if (!$b->isempty()) {
                return response()->json([
                    's' =>$b,
                    'message' => 'Quiz already done',
                ]);
            }
            $ans = QuizAnswer::create([
                'question_id' => $request->question_id,
                'option_id' => $request->option_id,
                'added_by' => auth('api')->user()->id,

            ]);
            $a = Answer::where('question_id',$request->question_id)->first();
            $q = Question::find($request->question_id);
            if ($request->option_id == $a->option_id) {
                $result = Result::create([
                    'question_id' => $request->question_id,
                    'status' => 'pass',
                    'added_by' => auth('api')->user()->id,
                    'point' => $q->point,
                ]);
            }else{
                $result = Result::create([
                    'question_id' => $request->question_id,
                    'status' => 'fail',
                    'added_by' => auth('api')->user()->id,
                    'point' => 0,
                ]);
            }

            $total_quiz = Result::where('added_by',auth('api')->user()->id)->get();
            $q = Result::where('added_by',auth('api')->user()->id)->pluck('question_id')->toArray();
            $s = Result::where('added_by',auth('api')->user()->id)->pluck('point')->toArray();
            $total_reward = array_sum($s);

            return response()->json([
                'total_quiz'=> $total_quiz->count(),
                'total_reward'=> $total_reward,
                'result' => $result,
                'message' => 'success',
            ]);
            
        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }
}
