<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Privacy;
use File;

class PrivacyController extends Controller
{
    protected $privacy =null ;
    public function __construct(Privacy $privacy)
    {
        $this->privacy = $privacy;       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Privacy::orderBY('id','DESC')->paginate(10);
        return view('admin.privacy')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.privacy-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->privacy->rules();
        $request->validate($rules);

        $data = $request->all();
        // dd($data);
        $this->privacy->fill($data);
        
        $status = $this->privacy->save();
        if ($status) {
            $request->session()->flash('success','Privacy created successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('privacy.index');
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
        $this->privacy = $this->privacy->find($id);
        if (!$this->privacy) {
            request()->session()->flash('error','privacy not found.');
            return redirect()->route('privacy.index');
        }        
        return view('admin.privacy-form')->with('privacy_detail',$this->privacy);  
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
        $rules = $this->privacy->rules('update');
        $request->validate($rules);
        
        $this->privacy = $this->privacy->find($id);
        // dd($this->privacy);
        if (!$this->privacy) {
            $request()->session()->flash('error','privacy not found.');
            return redirect()->route('privacy.index');
        }

        $data = $request->all();
        
        $this->privacy->fill($data);
        
        $status = $this->privacy->save();
        if ($status) {
            $request->session()->flash('success','file updated successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('privacy.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $privacy = $this->privacy->find($id);
        if(!$privacy){
            request()->session()->flash('error','privacy not found.');
            return redirect(route('privacy.index'));
        }
        $privacy->delete();
        return redirect(route('privacy.index'));
    }
}
