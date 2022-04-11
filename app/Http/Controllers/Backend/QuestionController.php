<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Option;
use App\Models\Answer;
use App\Models\Result;
use App\Models\DayWinner;
use App\Models\WeeklyWinner;
use App\Models\MonthlyWinner;
use App\Device;
use Auth;
use Session;
use Validation;
use File;
use Mail;
use Carbon\Carbon;

class QuestionController extends Controller
{
    public function __construct(Question $question)
    {
        $this->question = $question;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('option_info')->with('answer_info')->orderBy('id','desc')->get();
        $a = Carbon::yesterday();
        // dd($a);
       
        return view('admin.quiz.question-list')->with('data',$questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.question-form');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->question->rules('add');
        $request->validate($rules);
        
        $data = $request->all();
        $data['added_by'] = $request->user()->id;
    //    dd($data, $request);
        $this->question->fill($data); 
        $status = $this->question->save();
        if ($status) {
            $opt = $request->option_text;            
            foreach ($opt as $o) {
                $op = Option::create([
                    'question_id' => $this->question->id,
                    'added_by' => $request->user()->id, 
                    'option_text' => $o,
                ]);
            }
            if ($op) {
                $question = Question::find($this->question->id);
                $options = Option::where('question_id',$this->question->id)->pluck('option_text','id');
                return view('admin.quiz.answer-form')
                ->with('question',$question)           
                ->with('options',$options);            
            }
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
        $this->question = $this->question->find($id);
        if (!$this->question) {
            Session::flash('error','Question not found.');
            return redirect()->route('question.index');
        }  
        return view('admin.quiz.question-form')
        ->with('question_detail',$this->question);
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
        $this->question = $this->question->find($id);
        if(!$this->question){
            request()->session()->flash('error','Question not found.');
            return redirect()->back();
        }

        $rules = $this->question->rules('update');
        $request->validate($rules);

        $data= $request->all();
        $data['updated_by'] = $request->user()->id;
        // dd($data,$request);
        
        $this->question->fill($data);
        $status = $this->question->save();
        if ($status) {
            $o = Option::where('question_id',$id)->get();
            foreach ($o as $key => $value) {
                $value->update([
                    'option_text' => $request->option_text[$key],
                    'updated_by' =>$request->user()->id,
                ]);
            }

            $question = Question::find($this->question->id);
            $options = Option::where('question_id',$this->question->id)->pluck('option_text','id');
            $answer = Answer::find($this->question->id);
            return view('admin.quiz.answer-form')->with('answer_detail',$answer)
            ->with('options',$options)
            ->with('question',$question);
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
        $this->question = Question::findOrFail($id);
        $del = $this->question->delete();
        if($del){
            Session::flash('message','Question deleted successfully.');
        } else {
            Session::flash('error','Sorry! There was problem while deleting question.');
        }
        return redirect()->back();
    }
}
