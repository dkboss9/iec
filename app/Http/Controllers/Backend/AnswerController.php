<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Option;
use App\Models\Answer;

use Auth;
use Session;
use Validation;
use File;
use Mail;

class AnswerController extends Controller
{
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.answer-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->answer->rules('add');
        $request->validate($rules);
        
        $data = $request->all();
        $data['added_by'] = $request->user()->id;
        $opt =  Option::find($request->option_id);
        $data['answer'] = $opt->option_text;
    //    dd($data, $request);
        $this->answer->fill($data); 
        $status = $this->answer->save();
        if ($status) {
            Session::flash('message','Question added successfully.');
            return redirect()->route('quiz_questions');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $answer = Answer::where("question_id",$request->question_id)->first();
      // dd($request);
        $rules = $this->answer->rules('add');
        $request->validate($rules);
        $opt =  Option::find($request->option_id);
    
        $status = $answer->update([
            "question_id" => $request->question_id,
            "option_id"=>$request->option_id,
            "answer"=>$opt->option_text,
            "detail" => $request->detail
        ]); 
      //  $status = $answer->save();
        // dd($this->answer);
        if ($status) {
            Session::flash('message','Question updated successfully.');
            return redirect()->route('quiz_questions');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
