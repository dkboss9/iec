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
use App\Models\Quizprogram;
use Auth;
use Session;
use Validation;
use File;
use Mail;
use Carbon\Carbon;
use Image;

class Quiz_questionsController extends Controller
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
       
        return view('admin.quiz_questions.list')->with('data',$questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quiz_programs = Quizprogram::where("status","Active")->select("id","name")->get()->toarray();
        $q_p = [""=>"Select"];
       foreach($quiz_programs as $q){
           $q_p[$q["id"]] = $q["name"];
       }
        return view('admin.quiz_questions.question-form')->with("quiz_programs",$q_p);
        
    }

    public function upload(Request $request){
        if ($request->hasFile('file')) {
            // dd($request);
            $file_ext = $request->file('file');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/answer/'), $file_name,60);           
            $data['image']= $file_name;

            Image::make(public_path('upload/answer').'/'.$file_name)->resize(null, 90, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/answer').'/Thumb-lg-'.$file_name,60);

            $arr = ["file_name" => $file_name, "src" => asset('upload/answer/'.$file_name)];

            echo json_encode($arr);
           
        }
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

        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/question/'), $file_name,60);           
            $data['image']= $file_name;

            Image::make(public_path('upload/question').'/'.$file_name)->resize(null, 90, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/question').'/Thumb-lg-'.$file_name,60);

            $data["image"] = $file_name;
           
        }
        $this->question->fill($data); 
        $status = $this->question->save();
        if ($status) {

            $opt = $request->option_text;   
            $files=$request->txt_option_image;

            foreach ($opt as $key=>$o) {
              //  $file_ext = $file->file('answer_image');
             

                $op = Option::create([
                    'question_id' => $this->question->id,
                    'added_by' => $request->user()->id, 
                    'option_text' => $o,
                    'answer_image' => $files[$key]
                ]);
               
              }
        
           
            if ($op) {
                $question = Question::find($this->question->id);
                $options = Option::where('question_id',$this->question->id)->pluck('option_text','id');
                return view('admin.quiz_questions.answer-form')
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
        $quiz_programs = Quizprogram::where("status","Active")->select("id","name")->get()->toarray();
        $q_p = [""=>"Select"];
       foreach($quiz_programs as $q){
           $q_p[$q["id"]] = $q["name"];
       }
        $this->question = $this->question->find($id);
        if (!$this->question) {
            Session::flash('error','Question not found.');
            return redirect()->route('question.index');
        }  
        return view('admin.quiz_questions.question-form')
        ->with('question_detail',$this->question)->with("quiz_programs",$q_p);
    }

    public function delete_option_image(Request $request){
        $option = Option::find($request->id);
        if(!$option){
            request()->session()->flash('error','Question not found.');
            return redirect()->back();
        }

        $image_path = public_path('upload/answer/'.$option->answer_image);
        $thumb2 = public_path('upload/answer/'.'Thumb-lg-'.$option->answer_image);
        if(file_exists($image_path)){
            File::delete($thumb2);
            File::delete( $image_path);                   
        }
        $option->update(["answer_image" =>NULL]);
    }

    public function delete_image(Request $request){

        $this->question = $this->question->find($request->id);
        if(!$this->question){
            request()->session()->flash('error','Question not found.');
            return redirect()->back();
        }

        $image_path = public_path('upload/question/'.$this->question->image);
        $thumb2 = public_path('upload/question/'.'Thumb-lg-'.$this->question->image);
        if(file_exists($image_path)){
            File::delete($thumb2);
            File::delete( $image_path);                   
        }

        $this->question->update(["image" =>NULL]);
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

        if ($request->hasFile('image')) {
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/question/'), $file_name,60);           
            $data['image']= $file_name;

            File::delete($this->question->image);

            Image::make(public_path('upload/question').'/'.$file_name)->resize(null, 90, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/question').'/Thumb-lg-'.$file_name,60);

            $image_path = public_path('upload/question/'.$this->question->image);
            $thumb2 = public_path('upload/question/'.'Thumb-lg-'.$this->question->image);
            if(file_exists($image_path)){
                File::delete($thumb2);
                File::delete( $image_path);                   
            }
        }
        // dd($data,$request);
        
        $this->question->fill($data);
        $status = $this->question->save();
        if ($status) {
            $old_opts = Option::where('question_id',$id)->pluck("id")->toArray();
            $new_opt = $request->old_options;
            $removed_opts = array_diff($old_opts,$new_opt);
            Option::whereIn("id",$removed_opts)->delete();
            $opt = $request->option_text;   
            $files=$request->txt_option_image;

            foreach ($opt as $key=>$o) {
                if($new_opt[$key] == 0){
                     Option::create([
                        'question_id' => $this->question->id,
                        'added_by' => $request->user()->id, 
                        'option_text' => $o,
                        'updated_by' =>$request->user()->id,
                        'answer_image' => $files[$key]
                    ]);
                }else{
                    $option = Option::find($new_opt[$key]);
                    $option->update([
                        'question_id' => $this->question->id,
                        'added_by' => $request->user()->id, 
                        'option_text' => $o,
                        'updated_by' =>$request->user()->id,
                        'answer_image' => $files[$key]
                    ]);
                }
              
               
              }

            $question = Question::find($this->question->id);
            $options = Option::where('question_id',$this->question->id)->pluck('option_text','id');
            $answer = Answer::where("question_id",$this->question->id)->first();
           // dd($answer);
            return view('admin.quiz_questions.answer-form')->with('answer_detail',$answer)
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
