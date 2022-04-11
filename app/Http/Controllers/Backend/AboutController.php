<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use File;
use Auth;
use DB;



class AboutController extends Controller
{
    protected $about = null;

    public function __construct(About $about)
    {
        $this->about = $about;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = $this->about->with('created_by')->paginate(5);
        return view('admin.about')->with('about_data', $abouts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->about->rules();
        $request->validate($rules);
        
        $data = $request->except('image');
        // $data['detail'] = htmlentities($request->detail);
        $data['added_by'] = $request->user()->id;
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/about/'), $file_name);           
            $data['image']= $file_name;
        }

        $this->about->fill($data);
        
        $status = $this->about->save();
        if ($status) {
            $request->session()->flash('success','About uploaded successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('about.index');
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
        $this->about = $this->about->find($id);
        // dd($this->about);
        if (!$this->about) {
            request()->session()->flash('error','about not found.');
            return redirect()->route('about.index');
        }        
        return view('admin.about-form')->with('about_detail',$this->about);  
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
        $rules = $this->about->rules('update');
        $request->validate($rules);
        
        $this->about = $this->about->find($id);
        // dd($this->about);
        if (!$this->about) {
            $request()->session()->flash('error','about not found.');
            return redirect()->route('about.index');
        }

        $data = $request->except('image');
        // $data['detail'] = htmlentities($request->detail);
        $data['updated_by'] = $request->user()->id;
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            // $request->file->move('upload/'.$file_name); 
            $file_ext->move(public_path('upload/about/'), $file_name);           
            $data['image']= $file_name;

            File::delete($this->about->image);
        }
        $this->about->fill($data);
        
        $status = $this->about->save();
        if ($status) {
            $request->session()->flash('success','file updated successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('about.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = About::findOrFail($id);
        $image_path = public_path('upload/about/'.$data->image);
        if(file_exists($image_path)){
            File::delete( $image_path);
        }
        $data->delete();

        return redirect()->route('about.index');
    }
}
