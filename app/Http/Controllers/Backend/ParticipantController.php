<?php

namespace App\Http\Controllers\Backend;

//require 'vendor/autoload.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Aws;

use App\Models\Program;
use App\Models\Participant;
use File;
use DB;
use Auth;
use Image;
use Session;
use Carbon\Carbon;

class ParticipantController extends Controller
{
    protected $author = null;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Participant::all();
        return view('admin.program.participant')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program  = Program::pluck('title','id');
        return view('admin.program.participant-form')->with('program',$program);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $sdk = new Aws\Sdk([
            'region'      => 'ap-southeast-2',
            'version'  => 'latest',
            'credentials' => [
                'key' => "AKIATYSHCFT5WRL7OA4D",
                'secret'  => "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",
            ],
        ]);
        $s3Client = $sdk->createS3();
        $bucketName= 'firescreentv';
       
        // //Delete all Objects when versioning is not enabled
        // try {
        //     $objects = $s3Client->getIterator('ListObjects', ([
        //         'Bucket' => $bucketName
        //     ]));
        //     echo "Keys retrieved!\n";
        //     foreach ($objects as $object) {
        //         // echo $object['Key'] . "\n";
        //         $result = $s3Client->deleteObject([
        //             'Bucket' => $bucketName,
        //             'Key' => $object['Key'],
        //         ]);
        //     }
        //     $result = $s3Client->deleteBucket([
        //         'Bucket' => $bucketName,
        //     ]);
        // } catch (S3Exception $e) {
        //     dd($e->getMessage()) . "\n";
        // }


        if (!$s3Client->doesBucketExist($bucketName)) { 
            try {
                $result = $s3Client->createBucket([
                    'Bucket' => $bucketName,
                ]);
            }catch (AwsException $e) {
                // output error message if fails
                dd($e->getMessage());
                echo "\n";
            }          
        }
        
        // dd($request);
        $rules = $this->participant->rules();
        $request->validate($rules);
        
        $data = $request->except('image','identification','video');
        $data['added_by'] = $request->user()->id;
        $data['detail'] = htmlentities($request->detail);
        
        if ($request->hasFile('image')) {
            $file_ext = $request->file('image');
            $file_name = time().'-'.$file_ext->getClientOriginalName();
            $file_ext->move(public_path('upload/participant/'), $file_name,60);           
            $data['image']= $file_name;
            
            Image::make(public_path('upload/participant').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/participant').'/Thumb-lg-'.$file_name,60);
            
        }
        
        $images=array();
        if($files=$request->file('identification')){
            foreach($files as $file){
                $name= time().'-'.$file->getClientOriginalName();
                $file->move(public_path('upload/participant/'), $name,60);           
                $images[]=$name;
            }
            $data['identification'] =  implode("|",$images);
        }
        
        if ($request->file('video')) {
            $video = $request->file('video');
            $v_name= time().'-'.$video->getClientOriginalName();
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucketName,
                    'Key' => '/program-participate/' . $v_name,
                    'SourceFile' => $request->video,
                ]);
                // dd($result);
                $data['video']= $v_name;
                $data['video_url']=$result['ObjectURL'];
            } catch (S3Exception $e) {
                dd($e->getMessage()) . "\n";
            }
            // $s3 = \Storage::disk('s3');
            // $s3->put('/program-participate/' . $v_name, file_get_contents($video), 's3');
        }
        // dd($name,$data);
        $this->participant->fill($data);
        // dd($data, $this->participant);
        $status = $this->participant->save();
        if ($status) {
            Session::flash('message','Participant added successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('participant.index');
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
        $this->participant = $this->participant->find($id);
        if (!$this->participant) {
            Session::flash('error','Program not found.');
            return redirect()->route('participant.index');
        }   
        $program  = Program::pluck('title','id');
        return view('admin.program.participant-form')->with('program',$program)
        ->with('participant_detail',$this->participant);  
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
        $sdk = new Aws\Sdk([
            'region'      => 'ap-southeast-2',
            'version'  => 'latest',
            'credentials' => [
                'key' => "AKIATYSHCFT5WRL7OA4D",
                'secret'  => "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",
            ],
        ]);
        $s3Client = $sdk->createS3();
        $bucketName= 'firescreentv';

        // dd($request);
        $rules = $this->participant->rules('update');
        $request->validate($rules);
        
        $this->participant = $this->participant->find($id);
        // dd($this->participant);
        if (!$this->participant) {
            $Session::flash('error','Participant not found.');
            return redirect()->route('participant.index');
        }

        $data = $request->except('image','identification','video');
        // dd($data);
        if ($request->hasFile('image')) {
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/participant/'), $file_name,60);           
            $data['image']= $file_name;

            File::delete($this->participant->image);

            Image::make(public_path('upload/participant').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/participant').'/Thumb-sm-'.$file_name,60);

            $image_path = public_path('upload/participant/'.$this->participant->image);
            $thumb2 = public_path('upload/participant/'.'Thumb-lg-'.$this->participant->image);
            if(file_exists($image_path)){
                File::delete($thumb2);
                File::delete( $image_path);                   
            }
        }

        $images=array();
        if($files=$request->file('identification')){
            $array = explode("|", $this->participant->identification);
            foreach ($array as $item) {
                $img = public_path('upload/participant/'.$item);
                if ($img) {
                    File::delete($img);
                }
            }    
            foreach($files as $file){
                $name= time().'-'.$file->getClientOriginalName();
                $file->move(public_path('upload/participant/'), $name,60);           
                $images[]=$name;
            }
            $data['identification'] =  implode("|",$images);
        }
        
        if ($request->file('video')) {
            $video = $request->file('video');
            $v_name= time().'-'.$video->getClientOriginalName();
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucketName,
                    'Key' => '/program-participate/' . $v_name,
                    'SourceFile' => $request->video,
                ]);
                $old_video = $this->participant->video;
                $old_del = $s3Client->deleteObject([
                    'Bucket' => $bucketName,
                    'Key' => $old_video,
                ]);
                // dd($result);
                $data['video']= $v_name;
                $data['video_url']=$result['ObjectURL'];
            } catch (S3Exception $e) {
                dd($e->getMessage()) . "\n";
            }
            // $s3 = \Storage::disk('s3');
            // $s3->put('/program-participate/' . $v_name, file_get_contents($video), 's3');
        }
        $this->participant->fill($data);
        
        $status = $this->participant->save();
        if ($status) {
            Session::flash('message','Participant updated successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('participant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Participant::findOrFail($id);
        $image_path = public_path('upload/participant/'.$data->image);
        $thumb2 = public_path('upload/participant/'.'Thumb-lg-'.$data->image);

        $array = explode("|", $data->identification);
        foreach ($array as $item) {
           $img = public_path('upload/participant/'.$item);
           if ($img) {
               File::delete($img);
           }
        }       
        if(file_exists($image_path)){
            File::delete($thumb2);
            File::delete( $image_path);                   
        }
        $sdk = new Aws\Sdk([
            'region'      => 'ap-southeast-2',
            'version'  => 'latest',
            'credentials' => [
                'key' => "AKIATYSHCFT5WRL7OA4D",
                'secret'  => "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",
            ],
        ]);
        $s3Client = $sdk->createS3();
        $bucketName= 'firescreentv';
        $result = $s3Client->deleteObject([
            'Bucket' => $bucketName,
            'Key' => $data->video,
        ]);

        $del = $data->delete();
        if ($del) {
            Session::flash('message','Participant deleted successfully.');
            return redirect()->route('participant.index');
        }
    }

    public function view($video)
    {
        $sdk = new Aws\Sdk([
            'region'      => 'ap-southeast-2',
            'version'  => 'latest',
            'credentials' => [
                'key' => "AKIATYSHCFT5WRL7OA4D",
                'secret'  => "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",
            ],
        ]);
        $s3Client = $sdk->createS3();
        $bucketName= 'firescreentv';
        $result = $s3Client->getObject([
            'Bucket' => $bucketName,
            'Key' => '/program-participate/' . $video,
            'SaveAs' => '' . $video,
        ]);
        header("Content-Type: {$result['ContentType']}");
        echo $result['Body'];
    }

    public function download($video)
    {
        $sdk = new Aws\Sdk([
            'region'      => 'ap-southeast-2',
            'version'  => 'latest',
            'credentials' => [
                'key' => "AKIATYSHCFT5WRL7OA4D",
                'secret'  => "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",
            ],
        ]);
        $s3Client = $sdk->createS3();
        $bucketName= 'firescreentv';
        $result = $s3Client->getObject([
            'Bucket' => $bucketName,
            'Key' => '/program-participate/' . $video,
            'SaveAs' => '' . $video,
        ]);
        header("Content-Type: {$result['ContentType']}");
        echo $result['Body'];
    }
}
