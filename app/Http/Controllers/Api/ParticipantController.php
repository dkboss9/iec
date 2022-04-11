<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Aws;
use File;
use DB;
use Auth;
use Image;
use Session;
use Validator;
use Carbon\Carbon;

use App\Models\Program;
use App\Models\Participant;

class ParticipantController extends Controller
{
    public function programlist()
    {
        $data = Program::whereStatus('active')
            ->where('start','<=', Carbon::now())
            ->where('end','>=', Carbon::now())
            ->get();
        foreach ($data as $key => $value) {
            $value->image_url = url('/upload/program/'.$value->image);
        }
        if ($data) {
            return response()->json([
                'programs' => $data,
            ]);
        }
    }

    public function participantSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:256',
            'program_id'=>'required|exists:programs,id',
            'email' => 'required|email|unique:participants,email',
            'address' => 'required|string',
            'dob' => 'required|date',
            'phone' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'talent' => 'required|string',
            'status' => 'nullable|in:active,inactive',
            'image' => 'required|mimes:mimes:jpeg,png,jpg,gif,svg|max:5000',
            'identification' => 'required',
            'identification_type' => 'required|in:citizenship,license,passport,birth_certificate',
            'identification.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',      
            'video' =>'required|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts', 
           
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
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
        
        $data = $request->except('image','identification','video');
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
        $participant = new Participant();
        $participant->fill($data);
        // dd($data, $participant);
        $status = $participant->save();
        if ($status) {
            return response()->json([
                'participant' =>$participant,
                'message' => 'Your participant form saved succussfully. Wait for further notice.',
            ]);
        }else {
            return response()->json(['message'=>'error occured'],401);
        }
    }
}
