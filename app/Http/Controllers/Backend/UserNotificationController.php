<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use File;
use Hash;
use Session;

use App\User;
use App\Device;
use App\Models\News;
use App\Models\Annoucement;
use App\Models\UserNotification;

class UserNotificationController extends Controller
{
    protected $notification = null;
    public function __construct(UserNotification $notification)
    {
        $this->notification = $notification;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notification = UserNotification::orderBy('id','desc')->paginate(10);
        return view('admin.notification')->with('notification',$notification);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.send-notification');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->notification->getRules();
        $request->validate($rules);
        
        $data = $request->all();
        // dd($data);
        $this->notification->fill($data);
        $status = $this->notification->save();
        if($status){  
           $mass_id = $this->notification->id;

            $notif = Device::groupBy('token')->where('cat_id',null)->get();
                foreach ($notif as $value) {
                    if($value->cat_id == null){
                        $data['token'] = $value->token;
                        $data['status'] = $value->status;
                        $data['mass_id'] = $mass_id;
                        $n = Device::create($data);
                    }
                }
            $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
            $check = Device::groupBy('token')->where('status','yes')->where('media','yes')->where('cat_id',null)->where('post_id',null)->where('video_id',null)->where('mass_id',null)->get();
            foreach ($check as $item) {
                 //dd($item->cat_id, $this->video->cat_id);

                $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $item->token);
                $singleID = $notification['device_token'];
                // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
                if($notification['device_token'] != "" ){
                    #prep the bundle
                    $msg = array
                        (
                        'title' => $this->notification->title,
                        'body'	=> $this->notification->description,
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
                                    "mass_detail" => $this->notification,
                                    "quiz_detail" => '',
                                    "poll_detail" => '',

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
            
            Session::flash('message','Notification has been sent successfully.');
        } else {
            Session::flash('error','Sorry! There was problem while sending notification.');
        }
        return redirect()->route('usernotification.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->notification = UserNotification::findOrFail($id);
        // dd($child_id);
        $del = $this->notification->delete();
        if($del){
            Session::flash('success','Mass notification deleted successfully.');
        } else {
            Session::flash('error','Sorry! There was problem while deleting notification.');
        }
        return redirect()->back();
    }
}
