<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Author;
use App\Models\Contributor;
use File;
use Storage;
use Auth;
use DB;



class MediaController extends Controller
{
    protected $media =null ;
    protected $author =null ;
    protected $contributor =null ;
    public function __construct(Media $media, Author $author, Contributor $contributor)
    {
        $this->contributor = $contributor;
        $this->author = $author;
        $this->media = $media;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias = $this->media->with('created_by')->paginate(10);

        return view('admin.media')->with('media_data', $medias);
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
        return view('admin.media-form')
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
        // dd($request);
        $rules = $this->media->rules();
        $request->validate($rules);

        $data = $request->except('video');
        // $data['detail'] = htmlentities($request->detail);
        // dd($data);

        $data['added_by'] = $request->user()->id;
        if ($request->hasfile('video')) {
            $file_ext = $request->file('video');
            $file_name = $request->file('video')->getClientOriginalName();
            $s = Storage::disk('uploads')->putFileAs('/media/', $file_ext, $file_name);
            // print_r($s); die();
            // Storage::putFileAs('upload/media/', $file_ext, $file_name);
            // $file_ext->move(public_path('upload/media/'), $file_name);           
            $data['video']= $file_name;
        }
        
        // dd($data);
        $this->media->fill($data);
        
        $status = $this->media->save();
        if ($status) {
            $request->session()->flash('success','Media uploaded successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('media.index');
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
        $this->media = $this->media->find($id);
        // dd($this->media);
        if (!$this->media) {
            request()->session()->flash('error','media not found.');
            return redirect()->route('media.index');
        }        
        $contributor_info = $this->contributor->pluck('name','id');
        $author_info = $this->author->pluck('name','id');
        return view('admin.media-form')
            ->with('contributor_info',$contributor_info)
            ->with('author_info',$author_info)
            ->with('media_detail',$this->media);  
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
        $rules = $this->media->rules('update');
        $request->validate($rules);
        
        $this->media = $this->media->find($id);
        // dd($this->media);
        if (!$this->media) {
            $request()->session()->flash('error','media not found.');
            return redirect()->route('media.index');
        }

        $data['updated_by'] = $request->user()->id;
        // $data['detail'] = htmlentities($request->detail);

        $data = $request->except('video');
        if ($request->hasfile('video')) {
            $file_ext = $request->file('video');
            $file_name = $request->file('video')->getClientOriginalName();
            $file_ext->move(public_path('upload/media/'), $file_name);           
            $data['video']= $file_name;

            File::delete($this->media->video);

            $video_path = public_path('upload/media/'.$this->media->video);
            if(file_exists($video_path)){
                File::delete( $video_path); 
            } 

        }
        
        $this->media->fill($data);
        
        $status = $this->media->save();
        if ($status) {
            $request->session()->flash('success','file updated successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('media.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Media::findOrFail($id);
        $video_path = public_path('upload/media/'.$this->media->video);
            if(file_exists($video_path)){
                File::delete( $video_path); 
            } 
        $data->delete();

        return redirect()->route('media.index');
    }
}
