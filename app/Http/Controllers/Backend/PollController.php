<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Poll;
use App\Models\Vote;
use App\Models\Voter;
use App\Device;

use Auth;
use Session;
use Validation;
use File;
use Mail;
use Image;
use Carbon\Carbon;

class PollController extends Controller
{
    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poll = Poll::with('vote_info')->orderBy('id','desc')->get();
        // dd($poll);
        return view('admin.poll.poll-list')->with('data',$poll);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.poll.poll-form');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->poll->rules('add');
        $request->validate($rules);
        
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
    //    dd($data, $request);
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/poll/'), $file_name);           
            $data['image']= $file_name;

            Image::make(public_path('upload/poll').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/poll').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/poll').'/'.$file_name)->resize(null, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/poll').'/Thumb-lg-'.$file_name);
        }
        $this->poll->fill($data); 
        $status = $this->poll->save();
        if ($status) {
            $opt = $request->vote;            
            foreach ($opt as $o) {
                $op = Vote::create([
                    'poll_id' => $this->poll->id,
                    'added_by' => $request->user()->id, 
                    'vote' => $o,
                ]);
            }
            $poll_id = $this->poll->id;

            $notif = Device::groupBy('token')->where('cat_id',null)->get();
                foreach ($notif as $value) {
                    if($value->cat_id == null){
                        $data['token'] = $value->token;
                        $data['status'] = $value->status;
                        $data['voter_id'] = $poll_id;
                        $n = Device::create($data);
                    }
                }
            $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
            $check = Device::groupBy('token')->where('status','yes')->where('media','yes')
            ->where('cat_id',null)
            ->where('post_id',null)
            ->where('voter_id',null)
            ->where('quiz_id',null)
            ->where('video_id',null)->where('mass_id',null)->get();
            foreach ($check as $item) {
                 //dd($item->cat_id, $this->video->cat_id);

                $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $item->token);
                $singleID = $notification['device_token'];
                // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
                if($notification['device_token'] != "" ){
                    #prep the bundle
                    $msg = array
                        (
                        'title' => 'FSTV added new polling.',
                        'body'	=> $this->poll->title,
                        'icon'	=> '{{asset("plugins/logo1.png")}}',/*Default Icon*/
                        'sound' => 'mySound',/*Default sound*/
                        );

                    $fields = array
                            (
                                //'to'		=> $registrationIds,
                                'to' => $singleID,
                                'priority' => 'high',
                                'notification'	=> $msg,
                                'data' => [
                                    // "chat_user_id"=>$notification['chat_user_id'],
                                    "date"=>date('Y-m-d'),
                                    "news_detail" => '',
                                    "video_detail" => '',
                                    "mass_detail" => '',
                                    "quiz_detail" => '',
                                    "poll_detail" => $this->poll,

                                    // 'type_id' => $notification['notification_type_id'],
                                    // 'page'=>$notification['noticification_type']
                                    ]
                            );

                    $headers = array
                            (
                                // 'Authorization: key=' . $api_access_key,
                                'Authorization: Bearer '. $api_access_key,
                                'Content-Type: application/json'
                            );
                    #Send Reponse To FireBase Server
                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                    $result = curl_exec($ch );
                    curl_close( $ch );
                    #Echo Result Of FireBase Server
                    // echo $result;
                    // $result = json_decode($result);
                    // print_r($result);die();
                }
            }
            Session::flash('message','Added successfully.');
            return redirect()->route('poll.index');
        }
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
        $this->poll = $this->poll->find($id);
        if (!$this->poll) {
            Session::flash('error','Poll not found.');
            return redirect()->route('poll.index');
        }  
        return view('admin.poll.poll-form')
        ->with('poll_detail',$this->poll);
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
        $this->poll = $this->poll->find($id);
        if(!$this->poll){
            request()->session()->flash('error','Poll not found.');
            return redirect()->back();
        }

        $rules = $this->poll->rules('update');
        $request->validate($rules);

        $data= $request->except('image');
        $data['updated_by'] = $request->user()->id;
        // dd($data,$request);
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            // $request->file->move('upload/'.$file_name); 
            $file_ext->move(public_path('upload/poll/'), $file_name);           
            $data['image']= $file_name;

            File::delete($this->poll->image);

            Image::make(public_path('upload/poll').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/poll').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/poll').'/'.$file_name)->resize(null, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/poll').'/Thumb-lg-'.$file_name);

            $image_path = public_path('upload/poll/'.$this->poll->image);
            $thumb1 = public_path('upload/poll/'.'Thumb-sm-'.$this->poll->image);
            $thumb2 = public_path('upload/poll/'.'Thumb-lg-'.$this->poll->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        
        $this->poll->fill($data);
        $status = $this->poll->save();
        if ($status) {
            $o = Vote::where('poll_id',$id)->get();
            foreach ($o as $key => $value) {
                $value->update([
                    'option_text' => $request->vote[$key],
                    'updated_by' =>$request->user()->id,
                ]);
            }
            $poll = Poll::find($this->poll->id);
            $options = Vote::where('poll_id',$this->poll->id)->pluck('vote','id');
            return redirect()->route('poll.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->poll = Poll::findOrFail($id);
        $del = $this->poll->delete();
        if($del){
            Session::flash('message','Poll deleted successfully.');
        } else {
            Session::flash('error','Sorry! There was problem while deleting poll.');
        }
        return redirect()->back();
    }
}
