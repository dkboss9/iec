<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Voting;
use App\Models\VotingOption;
use App\Models\VotingResult;
use App\Device;

use Auth;
use Session;
use Validation;
use File;
use Mail;
use Image;
use Carbon\Carbon;

class VotingController extends Controller
{
    public function __construct(Voting $voting)
    {
        $this->voting = $voting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voting = Voting::orderBy('id','desc')->get();
        // dd($voting);
        return view('admin.voting.voting-list')->with('data',$voting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voting.voting-form');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->voting->rules('add');
        $request->validate($rules);

        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        if ($request->hasFile('image')) {
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/voting/'), $file_name);           
            $data['image']= $file_name;

            Image::make(public_path('upload/voting').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/voting').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/voting').'/'.$file_name)->resize(null, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/voting').'/Thumb-lg-'.$file_name);
        }
        
        $this->voting->fill($data); 
        $status = $this->voting->save();
        if ($status) {
            $n = $request->input('name');
            $d = $request->input('description');
            $s = $request->input('stat');
            $p = $request->file('photo');
        
            foreach($n as $key => $data) {
                $pdata = new VotingOption;
                $pdata->voting_id = $this->voting->id;
                $pdata->added_by = $request->user()->id;
                $pdata->name = $data;
                $pdata->description = isset($d[$key]) ? $d[$key] : ''; 
                $pdata->status = isset($s[$key]) ? $s[$key] : ''; 
                
                    $file_ext = isset($p[$key]) ? $p[$key] : '';
                    $file_name = time().'.'.$file_ext->getClientOriginalExtension();
                    $file_ext->move(public_path('upload/participant/'), $file_name);           
                    $pdata->photo = $file_name; 
        
                    Image::make(public_path('upload/participant').'/'.$file_name)->resize(null, 250, function ($constraints){
                        return $constraints->aspectRatio();
                    })->save(public_path('upload/participant').'/Thumb-lg-'.$file_name);

                    $pdata->save();
            }
            // $opt = $request->voption;            
            // foreach ($opt as $o) {
            //     $op = VotingOption::create([
            //         'voting_id' => $this->voting->id,
            //         'added_by' => $request->user()->id, 
            //         'voption' => $o,
            //     ]);
            // }
            $voting_id = $this->voting->id;
            // $voting_detail = Voting::with('voption_info')->where('id',$voting_id)->first();

            // $notif = Device::groupBy('token')->where('cat_id',null)->get();
            //     foreach ($notif as $value) {
            //         if($value->cat_id == null){
            //             $data['token'] = $value->token;
            //             $data['status'] = $value->status;
            //             $data['voter_id'] = $voting_id;
            //             $n = Device::create($data);
            //         }
            //     }
            // $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
            // $check = Device::groupBy('token')->where('status','yes')->where('media','yes')
            // ->where('cat_id',null)
            // ->where('post_id',null)
            // ->where('voter_id',null)
            // ->where('quiz_id',null)
            // ->where('video_id',null)->where('mass_id',null)->get();
            // foreach ($check as $item) {
            //      //dd($item->cat_id, $this->video->cat_id);

            //     $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $item->token);
            //     $singleID = $notification['device_token'];
            //     // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
            //     if($notification['device_token'] != "" ){
            //         #prep the bundle
            //         $msg = array
            //             (
            //             'title' => 'FSTV added new polling.',
            //             'body'	=> $this->voting->title,
            //             'icon'	=> '{{asset("plugins/logo1.png")}}',/*Default Icon*/
            //             'sound' => 'mySound',/*Default sound*/
            //             );

            //         $fields = array
            //                 (
            //                     //'to'		=> $registrationIds,
            //                     'to' => $singleID,
            //                     'priority' => 'high',
            //                     'notification'	=> $msg,
            //                     'data' => [
            //                         // "chat_user_id"=>$notification['chat_user_id'],
            //                         "date"=>date('Y-m-d'),
            //                         "news_detail" => '',
            //                         "video_detail" => '',
            //                         "mass_detail" => '',
            //                         "quiz_detail" => '',
            //                         "voting_detail" => $voting_detail,

            //                         // 'type_id' => $notification['notification_type_id'],
            //                         // 'page'=>$notification['noticification_type']
            //                         ]
            //                 );

            //         $headers = array
            //                 (
            //                     // 'Authorization: key=' . $api_access_key,
            //                     'Authorization: Bearer '. $api_access_key,
            //                     'Content-Type: application/json'
            //                 );
            //         #Send Reponse To FireBase Server
            //         $ch = curl_init();
            //         curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            //         curl_setopt( $ch,CURLOPT_POST, true );
            //         curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            //         curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            //         curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            //         curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            //         $result = curl_exec($ch );
            //         curl_close( $ch );
            //         #Echo Result Of FireBase Server
            //         // echo $result;
            //         // $result = json_decode($result);
            //         // print_r($result);die();
            //     }
            // }
            Session::flash('message','Added successfully.');
            return redirect()->route('voting.index');
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
        $this->voting = $this->voting->find($id);
        if (!$this->voting) {
            Session::flash('error','Voting not found.');
            return redirect()->route('voting.index');
        }  
        return view('admin.voting.voting-form')
        ->with('voting_detail',$this->voting);
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
        // dd($request);
        $this->voting = $this->voting->find($id);
        if(!$this->voting){
            request()->session()->flash('error','Voting not found.');
            return redirect()->back();
        }

        $rules = $this->voting->rules('update');
        $request->validate($rules);

        $data= $request->except('image');
        $data['updated_by'] = $request->user()->id;
        // dd($data,$request);
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            // $request->file->move('upload/'.$file_name); 
            $file_ext->move(public_path('upload/voting/'), $file_name);           
            $data['image']= $file_name;

            File::delete($this->voting->image);

            Image::make(public_path('upload/voting').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/voting').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/voting').'/'.$file_name)->resize(null, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/voting').'/Thumb-lg-'.$file_name);

            $image_path = public_path('upload/voting/'.$this->voting->image);
            $thumb1 = public_path('upload/voting/'.'Thumb-sm-'.$this->voting->image);
            $thumb2 = public_path('upload/voting/'.'Thumb-lg-'.$this->voting->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        
        $this->voting->fill($data);
        $status = $this->voting->save();
        if ($status) {
            $n = $request->input('name');
            $d = $request->input('description');
            $s = $request->input('stat');
            $p = $request->file('photo');
            $o = VotingOption::where('voting_id',$id)->get()->toArray();
            foreach($n as $key => $data) {
                $pdata = array();
                $pdata['voting_id'] = $this->voting->id;
                $pdata['added_by'] = $request->user()->id;
                $pdata['name'] = isset($n[$key]) ? $n[$key] : (isset($o[$key]['name']) ? $o[$key]['name']: '');
                $pdata['description'] = isset($d[$key]) ? $d[$key] : (isset($o[$key]['description']) ? $o[$key]['description']: ''); 
                $pdata['status'] = isset($s[$key]) ? $s[$key] : (isset($o[$key]['status']) ? $o[$key]['status']: ''); 
                
                if (@$o[$key]) {
                    $file_ext = isset($p[$key]) ? $p[$key] : '';
                    if ($file_ext) {
                            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
                            $file_ext->move(public_path('upload/participant/'), $file_name);           
                            $pdata['photo'] = $file_name; 
                
                            Image::make(public_path('upload/participant').'/'.$file_name)->resize(null, 250, function ($constraints){
                                return $constraints->aspectRatio();
                            })->save(public_path('upload/participant').'/Thumb-lg-'.$file_name);
        
                            $image_path = public_path('upload/participant/'.$o[$key]['photo']);
                            $thumb = public_path('upload/participant/'.'Thumb-lg-'.$o[$key]['photo']);
                            if(file_exists($image_path)){
                                File::delete($thumb);                      
                                File::delete( $image_path);                   
                            }
                        }
                    $m= VotingOption::where('id',$o[$key])->first();
                    $m->update($pdata);
                    
                }else{
                    $file_ext = isset($p[$key]) ? $p[$key] : '';
                    $file_name = time().'.'.$file_ext->getClientOriginalExtension();
                    $file_ext->move(public_path('upload/participant/'), $file_name);           
                    $pdata['photo'] = $file_name; 
                    // dd($pdata);
        
                    Image::make(public_path('upload/participant').'/'.$file_name)->resize(null, 250, function ($constraints){
                        return $constraints->aspectRatio();
                    })->save(public_path('upload/participant').'/Thumb-lg-'.$file_name);

                    $new = VotingOption::create($pdata);

                }

            }
            // $o = VotingOption::where('voting_id',$id)->get();
            // foreach ($o as $key => $value) {
            //     $value->update([
            //         'voption' => $request->voption[$key],
            //         'updated_by' =>$request->user()->id,
            //     ]);
            // }
            Session::flash('message','Updated successfully.');
            return redirect()->route('voting.index');

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
        $this->voting = Voting::findOrFail($id);
        $image_path = public_path('upload/voting/'.$this->voting->image);
        $thumb1 = public_path('upload/voting/'.'Thumb-sm-'.$this->voting->image);
        $thumb2 = public_path('upload/voting/'.'Thumb-lg-'.$this->voting->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);            
            File::delete( $image_path);                   
        }
        $op = VotingOption::where('voting_id',$id)->get();
        if ($op) {
            foreach ($op as $key => $value) {
                $image_path = public_path('upload/participant/'.$value->photo);
                $thumb1 = public_path('upload/participant/'.'Thumb-lg-'.$value->photo);
                if(file_exists($image_path)){
                    File::delete($thumb1);
                    File::delete( $image_path);                   
                }
            }
            $value->delete();
        }
        $del = $this->voting->delete();
        Session::flash('message','Voting deleted successfully.');
        return redirect()->back();
    }
    
    public function detail($id)
    {
        $data = VotingOption::find($id);
        // dd($data);
        return view('admin.voting.participant-detail')->with('data',$data);
    }

    public function votingResult()
    {
        $data= VotingResult::groupBy('voting_id')
        ->selectRaw('count(*) as total, voption_id, voting_id')
        ->with('participant_info','participant_info.program_info')
        ->get();
        $d = Voting::with('participant_info')->latest()->get();
        $a =array();
        foreach ($d as $key => $value) {
            
            foreach ($value->participant_info as $item) {
                $f = VotingResult::where('voting_id',$value->id)->where('voption_id',$item->id)->count();
                $item->total = $f;
            }
            $a[] = $value;
            
        }
        // dd($data,$a);
        return view('admin.voting.voting-result')->with('data',$a)->with('p',$d);
    }


}
