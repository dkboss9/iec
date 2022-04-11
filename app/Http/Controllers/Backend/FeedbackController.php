<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Session;
use App\User;
use App\Models\Feedback;


class FeedbackController extends Controller
{
    protected $feedback = null;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role != 'admin') {
            $data = Feedback::where('added_by',auth()->user()->id)->orderBy('id','desc')->paginate(10);
            return view('editor.feedback')->with('data',$data);
        }
        $data = Feedback::with('created_by')->orderBy('id','desc')->paginate(10);
        return view('admin.feedback')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->feedback->Rules('add');
        $request->validate($rules);
        $data = $request->all();               
        $data['added_by'] = $request->user()->id;

        $this->feedback->fill($data);        
        $status = $this->feedback->save();
        if ($status) {
            Session::flash('message','Your message has been sent to admin.');
        }else {
            Session::flash('error','Error occur.');
        }        
        return redirect()->route('feedback.index');
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
        //
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
