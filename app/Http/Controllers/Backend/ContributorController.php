<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contributor;
use File;
use Auth;
use DB;
use Image;



class ContributorController extends Controller
{
    protected $contributor = null;

    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributors = $this->contributor->with('created_by')->paginate(10);
        return view('admin.contributor')->with('contributor_data', $contributors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contributor-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->contributor->rules();
        $request->validate($rules);
        
        $data = $request->except('image');
        // $data['detail'] = htmlentities($request->detail);

        $data['added_by'] = $request->user()->id;
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/contributor/'), $file_name);           
            $data['image']= $file_name;
            
            Image::make(public_path('upload/contributor').'/'.$file_name)->resize(150, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/contributor').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/contributor').'/'.$file_name)->resize(800, 800, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/contributor').'/Thumb-lg-'.$file_name);
        }

        $this->contributor->fill($data);
        
        $status = $this->contributor->save();
        if ($status) {
            $request->session()->flash('success','Contributor uploaded successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('contributor.index');
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
        $this->contributor = $this->contributor->find($id);
        // dd($this->contributor);
        if (!$this->contributor) {
            request()->session()->flash('error','contributor not found.');
            return redirect()->route('contributor.index');
        }    
        // dd($this->contributor);    
        return view('admin.contributor-form')->with('contributor_detail',$this->contributor);  
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
        $rules = $this->contributor->rules('update');
        $request->validate($rules);
        
        $this->contributor = $this->contributor->find($id);
        // dd($this->contributor);
        if (!$this->contributor) {
            $request()->session()->flash('error','contributor not found.');
            return redirect()->route('contributor.index');
        }

        $data = $request->except('image');
        // $data['detail'] = htmlentities($request->detail);

        $data['updated_by'] = $request->user()->id;
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            // $request->file->move('upload/'.$file_name); 
            $file_ext->move(public_path('upload/contributor/'), $file_name);           
            $data['image']= $file_name;

            Image::make(public_path('upload/contributor').'/'.$file_name)->resize(150, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/contributor').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/contributor').'/'.$file_name)->resize(800, 800, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/contributor').'/Thumb-lg-'.$file_name);

            $image_path = public_path('upload/contributor/'.$this->contributor->image);
            $thumb1 = public_path('upload/contributor/'.'Thumb-sm-'.$this->contributor->image);
            $thumb2 = public_path('upload/contributor/'.'Thumb-lg-'.$this->contributor->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        $this->contributor->fill($data);
        
        $status = $this->contributor->save();
        if ($status) {
            $request->session()->flash('success','file updated successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('contributor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Contributor::findOrFail($id);
        $image_path = public_path('upload/contributor/'.$data->image);
        $thumb1 = public_path('upload/contributor/'.'Thumb-sm-'.$data->image);
        $thumb2 = public_path('upload/contributor/'.'Thumb-lg-'.$data->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);
          
            File::delete( $image_path);
        }
        $data->delete();

        return redirect()->route('contributor.index');
    }
}
