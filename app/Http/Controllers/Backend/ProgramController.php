<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

use Storage;
use App\Models\Program;
use App\Models\Participant;
use File;
use DB;
use Auth;
use Image;
use Session;
use Carbon\Carbon;


class ProgramController extends Controller
{
    protected $author = null;

    public function __construct(Program $program)
    {
        $this->program = $program;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Program::all();
        return view('admin.program.program')->with('data',$data);
    }
    public function participantList($id)
    {
        $program = Program::find($id);
        $data = Participant::where('program_id',$id)->latest()->get();
        return view('admin.program.program-participant-list')->with('program',$program)->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.program.program-form');
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
        $rules = $this->program->rules();
        $request->validate($rules);
        
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        // $data['detail'] = htmlentities($request->detail);
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/program/'), $file_name,60);           
            $data['image']= $file_name;

            Image::make(public_path('upload/program').'/'.$file_name)->resize(null, 90, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/program').'/Thumb-lg-'.$file_name,60);
           
        }

        $this->program->fill($data);
        
        $status = $this->program->save();
        if ($status) {
            Session::flash('message','Program added successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('program.index');

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
        $this->program = $this->program->find($id);
        if (!$this->program) {
            Session::flash('error','Program not found.');
            return redirect()->route('program.index');
        }        
        return view('admin.program.program-form')
        ->with('program_detail',$this->program);  
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
        $rules = $this->program->rules('update');
        $request->validate($rules);
        
        $this->program = $this->program->find($id);
        // dd($this->program);
        if (!$this->program) {
            $Session::flash('error','Program not found.');
            return redirect()->route('program.index');
        }

        $data['updated_by'] = $request->user()->id;
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/program/'), $file_name,60);           
            $data['image']= $file_name;

            File::delete($this->program->image);

            Image::make(public_path('upload/program').'/'.$file_name)->resize(null, 90, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/program').'/Thumb-lg-'.$file_name,60);

            $image_path = public_path('upload/program/'.$this->program->image);
            $thumb2 = public_path('upload/program/'.'Thumb-lg-'.$this->program->image);
            if(file_exists($image_path)){
                File::delete($thumb2);
                File::delete( $image_path);                   
            }
        }
        $this->program->fill($data);
        
        $status = $this->program->save();
        if ($status) {
            Session::flash('message','Program updated successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('program.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Program::findOrFail($id);
        $image_path = public_path('upload/program/'.$data->image);
        $thumb2 = public_path('upload/program/'.'Thumb-lg-'.$data->image);
        if(file_exists($image_path)){
            File::delete($thumb2);
            File::delete( $image_path);                   
        }
        $del = $data->delete();
        if ($del) {
            Session::flash('message','Program deleted successfully.');
            return redirect()->route('program.index');
        }
    }

    public function uploadLargeFiles(Request $request) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
    
        if (!$receiver->isUploaded()) {
            // file not uploaded
        }
    
        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name
    
            // $disk = Storage::disk(config('filesystems.default'));
            // $path = $disk->putFileAs('videos', $file, $fileName);
            $path = $file->move(public_path('upload/program-participate/'), $fileName);           

            $old_path = public_path('upload/program-participate/'.$request->vid);
            if ($old_path) {
                File::delete($old_path);
            }
    
            // delete chunked file
            // unlink($file->getPathname());
            return [
                'path' => asset('upload/program-participate/' . $fileName),
                'filename' => $fileName
            ];
        }
    
        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
