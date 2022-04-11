<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use File;
use Auth;
use DB;
use Image;


class AuthorController extends Controller
{
    protected $author = null;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = $this->author->with('created_by')->paginate(10);
        return view('admin.author')->with('author_data', $authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->author->rules();
        $request->validate($rules);
        
        $data = $request->except('image');
        // $data['detail'] = htmlentities($request->detail);
        $data['added_by'] = $request->user()->id;
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/author/'), $file_name);           
            $data['image']= $file_name;

            Image::make(public_path('upload/author').'/'.$file_name)->resize(150, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/author').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/author').'/'.$file_name)->resize(500, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/author').'/Thumb-lg-'.$file_name);
        }

        $this->author->fill($data);
        
        $status = $this->author->save();
        if ($status) {
            $request->session()->flash('success','Author uploaded successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('author.index');
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
        $this->author = $this->author->find($id);
        // dd($this->author);
        if (!$this->author) {
            request()->session()->flash('error','author not found.');
            return redirect()->route('author.index');
        }        
        return view('admin.author-form')->with('author_detail',$this->author);  
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
        $rules = $this->author->rules('update');
        $request->validate($rules);
        
        $this->author = $this->author->find($id);
        // dd($this->author);
        if (!$this->author) {
            $request()->session()->flash('error','author not found.');
            return redirect()->route('author.index');
        }

        $data['updated_by'] = $request->user()->id;
        // $data['detail'] = htmlentities($request->detail);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            // $request->file->move('upload/'.$file_name); 
            $file_ext->move(public_path('upload/author/'), $file_name);           
            $data['image']= $file_name;

            File::delete($this->author->image);

            Image::make(public_path('upload/author').'/'.$file_name)->resize(150, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/author').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/author').'/'.$file_name)->resize(500, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/author').'/Thumb-lg-'.$file_name);

            $image_path = public_path('upload/author/'.$this->author->image);
            $thumb1 = public_path('upload/author/'.'Thumb-sm-'.$this->author->image);
            $thumb2 = public_path('upload/author/'.'Thumb-lg-'.$this->author->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        $this->author->fill($data);
        
        $status = $this->author->save();
        if ($status) {
            $request->session()->flash('success','file updated successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('author.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Author::findOrFail($id);
        $image_path = public_path('upload/author/'.$data->image);
        $thumb1 = public_path('upload/author/'.'Thumb-sm-'.$data->image);
        $thumb2 = public_path('upload/author/'.'Thumb-lg-'.$data->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);
          
            File::delete( $image_path);                   
        }
        $data->delete();

        return redirect()->route('author.index');
    }
}
