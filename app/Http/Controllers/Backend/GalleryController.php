<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use File;
use Auth;
use Image;
use DB;
use Session;



class GalleryController extends Controller
{
    protected $gallery = null;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $gallerys = $this->gallery->with('created_by')->orderBy('id','desc')->paginate(10);
            return view('admin.gallery')->with('gallery_data', $gallerys);

        }elseif (auth()->user()->role == 'editor') {
            $gallerys = $this->gallery->where('added_by',auth()->user()->id)->whereStatus('inactive')->with('created_by')->orderBy('id','desc')->paginate(10);
            return view('editor.gallery')->with('gallery_data', $gallerys);

        }elseif (auth()->user()->role == 'operator') {
            $gallerys = $this->gallery->where('added_by',auth()->user()->id)->whereStatus('inactive')->with('created_by')->orderBy('id','desc')->paginate(10);
            return view('operator.gallery')->with('gallery_data', $gallerys);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role != 'admin') {
            if (@auth()->user()->editor_info['gallery'] == 1) {
                return view('editor.gallery-form');
            }elseif (@auth()->user()->operator_info['gallery'] == 1) {
                return view('operator.gallery-form');
            }else{
                Session::flash('error', 'You do not have access to add gallery.');
                return redirect()->route('gallery.index');
            }
        }
        return view('admin.gallery-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->gallery->rules();
        $request->validate($rules);
        
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/gallery/'), $file_name,60);           
            $data['image']= $file_name;

            Image::make(public_path('upload/gallery').'/'.$file_name)->resize(null, 200, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/gallery').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/gallery').'/'.$file_name,60)->resize(null, 400, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/gallery').'/Thumb-lg-'.$file_name,60);  
        }

        $this->gallery->fill($data);        
        $status = $this->gallery->save();
        if ($status) {
            Session::flash('message','Photo uploaded successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('gallery.index');
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
        $this->gallery = $this->gallery->find($id);
        // dd($this->gallery);
        if (!$this->gallery) {
            Session::flash('error','Gallery not found.');
            return redirect()->route('gallery.index');
        }  
        if (auth()->user()->role != 'admin' && $this->gallery->status == 'inactive') {
            if (auth()->user()->role == 'editor') {
                return view('editor.gallery-form')->with('gallery_detail', $this->gallery);
            }
            if (auth()->user()->role == 'operator') {
                return view('operator.gallery-form')->with('gallery_detail', $this->gallery);
            }
        }else{
            return view('admin.gallery-form')->with('gallery_detail',$this->gallery);  
        }      
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
        $rules = $this->gallery->rules('update');
        $request->validate($rules);
        
        $this->gallery = $this->gallery->find($id);
        // dd($this->gallery);
        if (!$this->gallery) {
            Session::flash('error','Gallery not found.');
            return redirect()->route('gallery.index');
        }

        $data['updated_by'] = $request->user()->id;
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            // $request->file->move('upload/'.$file_name); 
            $file_ext->move(public_path('upload/gallery/'), $file_name,60);           
            $data['image']= $file_name;

            File::delete($this->gallery->image);

            Image::make(public_path('upload/gallery').'/'.$file_name)->resize(null, 200, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/gallery').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/gallery').'/'.$file_name)->resize(null, 400, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/gallery').'/Thumb-lg-'.$file_name,60);

            $image_path = public_path('upload/gallery/'.$this->gallery->image);
            $thumb1 = public_path('upload/gallery/'.'Thumb-sm-'.$this->gallery->image);
            $thumb2 = public_path('upload/gallery/'.'Thumb-lg-'.$this->gallery->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        $this->gallery->fill($data);
        
        $status = $this->gallery->save();
        if ($status) {
            Session::flash('message','Gallery has been updated successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Gallery::findOrFail($id);
        $image_path = public_path('upload/gallery/'.$data->image);       
        $thumb1 = public_path('upload/gallery/'.'Thumb-sm-'.$data->image);
        $thumb2 = public_path('upload/gallery/'.'Thumb-lg-'.$data->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);          
            File::delete( $image_path);                   
        }
        $status = $data->delete();
        if ($status) {
            Session::flash('message', 'Photo has been deleted successfully.');
            return redirect()->route('gallery.index');
        }

    }
}
