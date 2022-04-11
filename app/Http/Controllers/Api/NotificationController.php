<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;


use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Auth;
use JWTAuth;
use Illuminate\Pagination\Paginator;

use App\Models\Post;
use App\Models\Category;
use App\Models\Video;
use App\Models\DayWinner;
use App\Device;

class NotificationController extends Controller
{

    public function addDevice(Request $request)
    {
        if($request->token != null){
            $data= Device::where('token',$request->token)->where('cat_id',null)
                ->where('post_id',null)
                ->where('video_id',null)
                ->where('quiz_id',null)
                ->where('voter_id',null)
                ->where('mass_id',null)->get();
            if ($data->isempty()) {    
                $input['token']= $request->token;
                $input['isview']= 'yes';
                $status = Device::create($input);
    
                $cat= Category::where('status','active')->where('parent_id', null)->get();
                foreach ($cat as $item) {
                    $input['token']= $request->token;
                    $input['cat_id']= $item->id;
                    $input['isview']= 'yes';
                    $status = Device::create($input);
                }
                $count = 0;
                return response()->json([
                    'token' => $request->token,
                    'count' => $count,
                ]);
            }else{
                $count = Device::where('token',$request->token)->where('isview','no')->count(); 
                return response()->json([
                    'token' => $request->token,
                    'count' => $count,
                ]);          
            }
        }
    }
    
    public function notify(Request $request)
    { 
        $news = Post::first();

        $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
        $tok = Device::where('status','yes')->get();
        foreach ($tok as $item) { 
            $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $item->token);
            $singleID = $notification['device_token'];
            // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
            if($notification['device_token'] != "" ){
                #prep the bundle
                $msg = array
                    (
                    'body' 	=> $news->title,
                    'title'	=> 'FSTV has posted new news.',
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
                                "news_detail" => $news,
                                // 'type_id' => $notification['notification_type_id'],
                                // 'page'=>$notification['noticification_type']
                                ]
                        );

                $headers = array
                        (
                            'Authorization: key=' . $api_access_key,
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
                // print_r($result);
            }            
        }
    }

    public function notification(Request $request,$token)
    {
        if ($token != null) {
            $up_count = Device::where('token',$token)->update(['isview'=>'yes']);
            
            $device = Device::where('token',$token)->where('cat_id',null)
                ->with('post_info')->with('video_info')
                ->with('mass_info')
                ->with('voter_info','voter_info.vote_info')
                ->where(function($q){
                $q->Where('post_id','!=',null)
                ->orWhere('video_id','!=',null)->orWhere('voter_id','!=',null)->orWhere('mass_id','!=',null);
            })->latest()->get(); 
            foreach ($device as $item) {
                $item->quiz_info = '';
              if($item->voter_info != null){
                $item->voter_info['image_url'] = url('/upload/poll/'.$item->voter_info['image']);
              }
            }  
            $not = Device::where('token',$token)->where('cat_id',null)
                ->with('post_info')->with('video_info')
                ->with('mass_info')
                ->with('voter_info','voter_info.vote_info')
                ->where(function($q){
                $q->Where('post_id','!=',null)
                ->orWhere('video_id','!=',null)->orWhere('voter_id','!=',null)->orWhere('mass_id','!=',null);
            })->latest()->paginate(10); 
            foreach ($not as $item) {
                $item->quiz_info = '';
              if($item->voter_info != null){
                $item->voter_info['image_url'] = url('/upload/poll/'.$item->voter_info['image']);
              }
            } 
            
            if (Auth::guard('api')->check()){

                $d = Device::where('token',$token)->where('cat_id',null)
                ->where('post_id',null)
                ->where('video_id',null)
                ->where('voter_id',null)
                ->where('quiz_id',null)
                ->where('mass_id',null)->where('user_id','!=',null)->first();
                
                if ($d == null) {
                    return response()->json([
                        'data'=>$not,
                    ]);
                }else{
                    $win = DayWinner::where('user_id',$d->user_id)->latest()->get(); 
                    if(empty($win)){
                      return response()->json([
                            'data'=>$not,
                        ]);
                    }else{
                        foreach ($win as $k=>$item) {
                          $item->title = "You are the winner of FirescreenTv's Daily quiz.";
                          $item->detail = "For more detail, Please contact us.";
                          $item->quiz_info = [
                              'title'=>"You are the winner of FirescreenTv's Daily quiz.",
                              'detail'=>"For more detail, Please contact us.",
                              'created_at'=> $item->created_at,
                          ];
                          $item->mass_info = '';
                          $item->post_info = '';
                          $item->video_info = '';
                          $item->voter_info = '';
                        }
    
                       // $me = array_merge($device->toArray(),$win->toArray());
                        $me = $device->merge($win)->paginate(10);
        
                        return response()->json([
                            'data'=>$me,
                        ]);
                    }

                }

            }else{
                return response()->json([
                    'data'=>$not,
                ]);
            }
            
              
           
        }else{
            return response()->json([
                'messsage' => 'Please enable notification in app settings.'
            ],401);
        }
       
        // $device = Device::where('token',$token)->first();
        // $date = $device->created_at;

        // $news= Post::whereStatus('active')->where('created_at','>=',$date)->orderBy('created_at','desc')->get()->toArray();
        // $videos= Video::whereStatus('active')->where('created_at','>=',$date)->orderBy('created_at','desc')->get()->toArray();
       
        // $results = $news->merge($videos)->sortByDesc('created_at');
         
        // $results = array_merge($news, $videos);
        // usort($results, function($a,$b) { 
        //     $results =  $a['created_at'] > $b['created_at'];
        // });
        // // $pagination = new Paginator($pagedData, $perPage)
        // $result = new Paginator($results, 10);
        // return response()->json([
        //     'data' => $result,
        // ]);
    }
  
    public function notifySetting(Request $request,$token)
    {
        if ($token != null) {
            $device = Device::where('token',$token)->get();
            $main = Device::where('token',$token)->first();
          
            $category = Category::where('status','active')->where('parent_id',null)->get();
            foreach ($category as $value) {
                foreach ($device as $item) {
                    if($value->id == $item->cat_id){
                        $value->flag = "yes";
                        break;
                    }else{
                        $value->flag = "no";
                    }            
                }
            }
            
            return response()->json([
                'main' => $main,
                'category' => $category,
            ]);            
        }else{
            return response()->jason([
                'message' => 'Please enable notification in app settings.'
            ], 401);
        }
    }

    public function notifyMain(Request $request)
    {
        $device = Device::where('token',$request->token)->get();
        // return response()->json($device);
        if ($device) {
            $token = $request->token;
            $status = $request->status;
                if ($status == 'yes') {
                    Device::where('token',$token)->update(['status' => 'yes']);
                    return response()->json([
                        'message' => "Notification Enabled.",
                    ]);
                }elseif($status == 'no'){
                    Device::where('token',$token)->update(['status' => 'no']);
                    return response()->json([
                        'message' => "Notification Disabled.",
                    ]);
                }            
            
        }
    }

    public function notifyMedia(Request $request)
    {
        $device = Device::whereToken($request->token)->get();
        if ($device) {
            $token = $request->token;
            $media = $request->media;
            if ($media == 'yes') {
                Device::where('token',$token)->update(['media' => 'yes']);
                return response()->json([
                    'message' => "FSTV video notification Enabled.",
                ]);
            }elseif($media == 'no'){
                Device::where('token',$token)->update(['media' => 'no']);
                return response()->json([
                    'message' => "FSTV video notification Disabled.",
                ]);
            }
            return response()->json(['s'=>$request]);
            
        }
    }

    public function notifyCategory(Request $request,$cat_id)
    {
        $device = Device::whereToken($request->token)->where('cat_id',$cat_id)->first();
        if ($device) {
            $device->delete();            
        }else{
            $data = new Device();
            $data['token'] = $request->token;
            $data['isview'] = "yes";
            $data['cat_id'] = $cat_id;
            $data->save();
        }
        return response()->json([
            'message'=> 'Setting changed.',
        ]);
    }

    public function noti()
    {
        return response()->json([
          'message' => 'Please enable notification in app settings.'
        ],401);
    }
    public function notiset()
    {
        return response()->json([
            'message' => 'Please enable notification in app settings.'
        ],401);
    }
}
