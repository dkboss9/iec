<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Author;
use App\Models\Contributor;
use File;
use Auth;
use Session;
use Image;
use DB;



class BlogController extends Controller
{
    protected $blog = null;
    protected $contributor = null;
    protected $author = null;

    public function __construct(Blog $blog, Author $author, Contributor $contributor)
    {
        $this->author = $author;
        $this->contributor = $contributor;
        $this->blog = $blog;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $blogs = $this->blog->with('created_by')->orderBy('id','desc')->paginate(10);
            return view('admin.blog')->with('blog_data', $blogs);

        }elseif (auth()->user()->role == 'editor') {
            $blogs = $this->blog->where('added_by',auth()->user()->id)->whereStatus('inactive')->with('created_by')->orderBy('id','desc')->paginate(10);
            return view('editor.blog')->with('blog_data', $blogs);

        }elseif (auth()->user()->role == 'operator') {
            $blogs = $this->blog->where('added_by',auth()->user()->id)->whereStatus('inactive')->with('created_by')->orderBy('id','desc')->paginate(10);
            return view('operator.blog')->with('blog_data', $blogs);
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contributor_info = $this->contributor->pluck('name','id');
        $author_info = $this->author->pluck('name','id');
        if (auth()->user()->role != 'admin') {
            if (@auth()->user()->editor_info['blog'] == 1) {
                return view('editor.blog-form');
            }elseif (@auth()->user()->operator_info['blog'] == 1) {
                return view('operator.blog-form');
            }else{
                Session::flash('error', 'You do not have access to add blog.');
                return redirect()->route('blog.index');
            }
        }
        return view('admin.blog-form')
            ->with('contributor_info',$contributor_info)
            ->with('author_info',$author_info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->blog->rules();
        $request->validate($rules);
        
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        // $data['detail'] = htmlentities($request->detail);
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/blog/'), $file_name,60);           
            $data['image']= $file_name;

            Image::make(public_path('upload/blog').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/blog').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/blog').'/'.$file_name)->resize(null, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/blog').'/Thumb-lg-'.$file_name,60);
        }

        $this->blog->fill($data);
        
        $status = $this->blog->save();
        if ($status) {
            Session::flash('message','Blog uploaded successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('blog.index');
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
        $this->blog = $this->blog->find($id);
        $contributor_info = $this->contributor->pluck('name','id');
        $author_info = $this->author->pluck('name','id');
        // dd($this->blog);
        if (!$this->blog) {
            Session::flash('error','Blog not found.');
            return redirect()->route('blog.index');
        }        
        if (auth()->user()->role != 'admin' && $this->blog->status == 'inactive') {
            if (auth()->user()->role == 'editor' && auth()->user()->editor_info['blog'] == 1) {
                return view('editor.blog-form')->with('blog_detail', $this->blog);
            }
            if (auth()->user()->role == 'operator' && auth()->user()->operator_info['blog'] == 1) {
                return view('operator.blog-form')->with('blog_detail', $this->blog);
            }
        }
        return view('admin.blog-form')->with('contributor_info',$contributor_info)
        ->with('author_info',$author_info)
        ->with('blog_detail',$this->blog);  
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
        $rules = $this->blog->rules('update');
        $request->validate($rules);
        
        $this->blog = $this->blog->find($id);
        // dd($this->blog);
        if (!$this->blog) {
            $Session::flash('error','BLog not found.');
            return redirect()->route('blog.index');
        }

        $data['updated_by'] = $request->user()->id;
        // $data['detail'] = htmlentities($request->detail);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            // $request->file->move('upload/'.$file_name); 
            $file_ext->move(public_path('upload/blog/'), $file_name,60);           
            $data['image']= $file_name;

            File::delete($this->blog->image);

            Image::make(public_path('upload/blog').'/'.$file_name)->resize(300, 250, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/blog').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/blog').'/'.$file_name)->resize(728, 90, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/blog').'/Thumb-lg-'.$file_name,60);

            $image_path = public_path('upload/blog/'.$this->blog->image);
            $thumb1 = public_path('upload/blog/'.'Thumb-sm-'.$this->blog->image);
            $thumb2 = public_path('upload/blog/'.'Thumb-lg-'.$this->blog->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        $this->blog->fill($data);
        
        $status = $this->blog->save();
        if ($status) {
            Session::flash('message','Blog updated successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Blog::findOrFail($id);
        $image_path = public_path('upload/blog/'.$data->image);
        $thumb1 = public_path('upload/blog/'.'Thumb-sm-'.$data->image);
        $thumb2 = public_path('upload/blog/'.'Thumb-lg-'.$data->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);
          
            File::delete( $image_path);                   
        }
        $del = $data->delete();
        if ($del) {
            Session::flash('message','Blog deleted successfully.');
            return redirect()->route('blog.index');
        }
    }
}
