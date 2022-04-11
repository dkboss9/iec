<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Termncondition;
use File;

class TermnconditionController extends Controller
{
    protected $termncondition =null ;
    public function __construct(Termncondition $termncondition)
    {
        $this->termncondition = $termncondition;       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Termncondition::orderBY('id','DESC')->paginate(10);
        return view('admin.termncondition')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.termncondition-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->termncondition->rules();
        $request->validate($rules);
        // dd($request);

        $data = $request->all();
        // dd($data);
        $this->termncondition->fill($data);
        
        $status = $this->termncondition->save();
        if ($status) {
            $request->session()->flash('success','Term and Condition created successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('terms.index');
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
        $this->termncondition = $this->termncondition->find($id);
        if (!$this->termncondition) {
            request()->session()->flash('error','termncondition not found.');
            return redirect()->route('terms.index');
        }        
        return view('admin.termncondition-form')->with('termncondition_detail',$this->termncondition);  
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
        $rules = $this->termncondition->rules('update');
        $request->validate($rules);
        
        $this->termncondition = $this->termncondition->find($id);
        // dd($this->termncondition);
        if (!$this->termncondition) {
            $request()->session()->flash('error','termncondition not found.');
            return redirect()->route('terms.index');
        }

        $data = $request->all();
        
        $this->termncondition->fill($data);
        
        $status = $this->termncondition->save();
        if ($status) {
            $request->session()->flash('success','file updated successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('terms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $termncondition = $this->termncondition->find($id);
        if(!$termncondition){
            request()->session()->flash('error','termncondition not found.');
            return redirect(route('terms.index'));
        }
        $termncondition->delete();
        return redirect(route('terms.index'));
    }
}
