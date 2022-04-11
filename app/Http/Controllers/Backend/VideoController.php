<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Childmenu;
use App\Models\Notification;
use App\Models\Featured;
use App\Models\History;
use App\Models\UsersCategory;
use App\Models\Popular;
use App\Device;
use File;
use Auth;
use Image;
use Validation;
use Storage;
use Session;
use Carbon\Carbon;


class VideoController extends Controller
{

    protected $video = null;
    protected $featured = null;
    protected $popular = null;
    public function __construct(Video $video, Featured $featured, Popular $popular)
    {
        $this->popular = $popular;
        $this->featured = $featured;
        $this->video = $video;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $featured = Featured::where("added_by", Auth::user()->id)->get()->toArray();
        // $featured_video_id = array_column($featured,"video_id");

        // $popular = Popular::where("added_by", Auth::user()->id)->get()->toArray();
        // $popular_video_id = array_column($popular,"video_id");

        if (auth()->user()->role == 'admin') {
            $data = Video::with('menu_info')->orderBy('id','desc')->orderBy('id','desc')->paginate(10);
            $featured = Featured::where("added_by", '!=', null)->get()->toArray();
            $featured_video_id = array_column($featured,"video_id");
            
            $popular = Popular::where("added_by", '!=', null)->get()->toArray();
            $popular_video_id = array_column($popular,"video_id");
            return view('admin.fstv.video')->with('data',$data)
            ->with('popular_video_id', $popular_video_id)
            ->with('featured_video_id', $featured_video_id);

        }elseif (auth()->user()->role == 'editor') {
            $data = Video::whereStatus('inactive')->where('added_by',auth()->user()->id)
            ->with('menu_info')->orderBy('id','desc')
            ->get();

            $p = array_column($data->toArray(),'id');            
            $featured = Featured::whereIn("video_id", $p)->get()->toArray();
            $featured_video_id = array_column($featured,"video_id");
            $popular = Popular::whereIn("video_id", $p)->get()->toArray();
            $popular_video_id = array_column($popular,"video_id");

            return view('editor.video')->with('data',$data)
            ->with('popular_video_id', $popular_video_id)
            ->with('featured_video_id', $featured_video_id);

        }elseif (auth()->user()->role == 'operator') {
            $data = Video::whereStatus('inactive')->where('added_by',auth()->user()->id)
            ->with('menu_info')->orderBy('id','desc')
            ->get();

            $p = array_column($data->toArray(),'id');            
            $featured = Featured::whereIn("video_id", $p)->get()->toArray();
            $featured_video_id = array_column($featured,"video_id");
            $popular = Popular::whereIn("video_id", $p)->get()->toArray();
            $popular_video_id = array_column($popular,"video_id");

            return view('operator.video')->with('data',$data)
            ->with('popular_video_id', $popular_video_id)
            ->with('featured_video_id', $featured_video_id);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'admin' &&  Auth::user()->status == 'active') {
            $menu_info = Menu::where('status','active')->with('childmenu_info')->pluck('title','id');
            return view('admin.fstv.video-form')->with('menu_info', $menu_info);

        }elseif (Auth::user()->role == 'editor' &&  Auth::user()->status == 'active') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('menu_id','!=',null)->pluck('menu_id')->toArray();
            if ($ca != null) {
                $menu_info = Menu::whereIn('id',$ca)->where('status','active')->with('childmenu_info')->pluck('title','id');
                return view('editor.video-form')->with('menu_info', $menu_info);                
            }else{
                Session::flash('error','You do not have access to add video.');
                return redirect()->back();
            }

        }elseif (Auth::user()->role == 'operator' &&  Auth::user()->status == 'active') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('menu_id','!=',null)->pluck('menu_id')->toArray();
            if ($ca != null) {
                $menu_info = Menu::whereIn('id',$ca)->where('status','active')->with('childmenu_info')->pluck('title','id');
                return view('operator.video-form')->with('menu_info', $menu_info);
            }else{
                Session::flash('error','You do not have access to add video');
                return redirect()->back();
            }
                

        }else{
            return redirect()->back();
        }

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
        $rules = $this->video->rules();
        $request->validate($rules);

        $data = $request->except('video','image');
        // dd($data);
        // $data['detail'] = htmlentities($request->detail);
        $data['added_by'] = $request->user()->id;

    	$tags = explode(",", $request->tags);

        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/fstv/video/'), $file_name);
            $data['image']= $file_name;

            Image::make(public_path('upload/fstv/video').'/'.$file_name)->resize(150, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/video').'/Thumb-sm-'.$file_name);
            Image::make(public_path('upload/fstv/video').'/'.$file_name)->resize(500, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/video').'/Thumb-lg-'.$file_name);
        }
        if ($request->hasfile('video')) {
            $file_ext = $request->file('video');
            $file_name = $request->file('video')->getClientOriginalName();
            $s = Storage::disk('uploads')->putFileAs('/fstv/video/', $file_ext, $file_name);

            $data['video']= $file_name;
        }

        // dd($data);
        $this->video->fill($data);

        // dd($data);
        $status = $this->video->save();
        $this->video->tag($tags);
        if ($status) {
                      if ($request->notify != null) {


           $video_id = $this->video->id;
           $active = $this->video->status;

            if ($this->video->status == 'active' && $this->video->date <= Carbon::today()->format('Y-m-d')) {

            $notif = Device::groupBy('token')->where('cat_id',null)->get();
                foreach ($notif as $value) {
                    if($value->cat_id == null){
                        $data['token'] = $value->token;
                        $data['status'] = $value->status;
                        $data['video_id'] = $video_id;
                        $n = Device::create($data);
                    }
                }
            $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
            $check = Device::groupBy('token')->where('status','yes')->where('media','yes')
            ->where('cat_id',null)
            ->where('voter_id',null)
            ->where('quiz_id',null)
            ->where('post_id',null)->where('video_id',null)->get();
            foreach ($check as $item) {
                 //dd($item->cat_id, $this->video->cat_id);

                $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $item->token);
                $singleID = $notification['device_token'];
                // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
                if($notification['device_token'] != "" ){
                    #prep the bundle
                    $msg = array
                        (
                        'body' 	=> $this->video->title,
                        'title'	=> 'FSTV posted new Video.',
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
                                    "video_detail" => $this->video->id,
                                    "mass_detail" => '',
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
            }
                      }
            Session::flash('message', "Video has been added successfully.");
            return redirect(route('video.index'));
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
        $this->video = $this->video->with('tagged')->find($id);
        $submenu_info = Submenu::pluck('title','id');
        $childmenu_info = Childmenu::pluck('title','id');

        if (Auth::user()->role == 'admin' &&  Auth::user()->status == 'active') {
            $menu_info = Menu::where('status','active')->with('childmenu_info')->pluck('title','id');
            return view('admin.fstv.video-form')
            ->with('video_detail',$this->video)
            ->with('childmenu_info',$childmenu_info)
            ->with('submenu_info',$submenu_info)
            ->with('menu_info',$menu_info);

        }elseif (Auth::user()->role == 'editor' &&  Auth::user()->status == 'active') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('menu_id','!=',null)->pluck('menu_id')->toArray();
            $menu_info = Menu::whereIn('id',$ca)->where('status','active')->with('childmenu_info')->pluck('title','id');
            return view('editor.video-form')
            ->with('video_detail',$this->video)
            ->with('childmenu_info',$childmenu_info)
            ->with('submenu_info',$submenu_info)
            ->with('menu_info',$menu_info);

        }elseif (Auth::user()->role == 'operator' &&  Auth::user()->status == 'active') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('menu_id','!=',null)->pluck('menu_id')->toArray();
            $menu_info = Menu::whereIn('id',$ca)->where('status','active')->with('childmenu_info')->pluck('title','id');
            return view('operator.video-form')
            ->with('video_detail',$this->video)
            ->with('childmenu_info',$childmenu_info)
            ->with('submenu_info',$submenu_info)
            ->with('menu_info',$menu_info);

        }else{
            return redirect()->back();
        }
               
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
      //dd($request->notify);

        $this->video = $this->video->with('menu_info')->find($id);
        if(!$this->video){
            Session::flash('error','video not found.');
            return redirect(route('video.index'));
        }
        $rules = $this->video->rules('update');
        $request->validate($rules);

        $data = $request->except('is_trending','video','image');
        $data['is_trending'] = $request->has('is_trending');
        // $data['detail'] = htmlentities($request->detail);
    	$tags = explode(",", $request->tags);
        // dd($data);

        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/fstv/video/'), $file_name,60);
            $data['image']= $file_name;

            File::delete($this->video->image);

            Image::make(public_path('upload/fstv/video').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/video').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/fstv/video').'/'.$file_name)->resize(null, 300, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/video').'/Thumb-lg-'.$file_name,60);

            $image_path = public_path('upload/fstv/video/'.$this->video->image);
            $thumb1 = public_path('upload/fstv/video/'.'Thumb-sm-'.$this->video->image);
            $thumb2 = public_path('upload/fstv/video/'.'Thumb-lg-'.$this->video->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);

                File::delete( $image_path);
            }
        }

        if ($request->hasfile('video')) {
            $file_ext = $request->file('video');
            $file_name = $request->file('video')->getClientOriginalName();
            $s = Storage::disk('uploads')->putFileAs('/fstv/video/', $file_ext, $file_name);

            $data['video']= $file_name;

            $video_path = public_path('upload/fstv/video/'.$this->video->video);
            if(file_exists($video_path)){
                File::delete( $video_path);
            }
        }

        // dd($data);
        $this->video->fill($data);

        // dd($data);
        $status = $this->video->save();
        $this->video->retag($tags);
        if ($status) {
            if ($request->notify != null) {

           $video_id = $this->video->id;
           $active = $this->video->status;

          $already = Device::where('video_id',$video_id)->get();
          foreach($already as $item){
            $item->delete();
          }

            if ($this->video->status == 'active' && $this->video->date <= Carbon::today()->format('Y-m-d')) {

            $notif = Device::groupBy('token')->where('cat_id',null)->get();
                foreach ($notif as $value) {
                    if($value->cat_id == null){
                        $data['token'] = $value->token;
                        $data['status'] = $value->status;
                        $data['video_id'] = $video_id;
                        $n = Device::create($data);
                    }
                }
            $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
            $check = Device::groupBy('token')->where('status','yes')
            ->where('media','yes')->where('cat_id',null)
            ->where('post_id',null)
            ->where('voter_id',null)
            ->where('quiz_id',null)
            ->where('video_id',null)->get();
            foreach ($check as $item) {
                 //dd($item->cat_id, $this->video->cat_id);

                $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $item->token);
                $singleID = $notification['device_token'];
                // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
                if($notification['device_token'] != "" ){
                    #prep the bundle
                    $msg = array
                        (
                        'body' 	=> $this->video->title,
                        'title'	=> 'FSTV updated a Video.',
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
                                  "video_detail" => $this->video->id,
                                  "mass_detail" => '',
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
            }
                      }

            Session::flash('message', "Video-info has been updated successfully.");
            return redirect()->route('video.index');
        }

    }

    public function popular(Request $request)
    {
        $data['video_id'] = $_POST['popular_id'];
        $data['added_by'] = $request->user()->id;
        // dd($data);

        $this->popular->fill($data);
        $status = $this->popular->save();
        if ($status) {
            Session::flash('message','added successfully.');
        }else {
            Session::flash('eroor','Problem occured');
        }
        return redirect()->route('video.index');
    }

    public function unpopular()
    {
        $data['video_id'] = $_POST['popular_id'];
        // echo $data['popular_id'];
        $del = Popular::where([
            "video_id"=> $data['video_id'],
            "added_by"=> Auth::user()->id
            ])->delete();
    }
    public function feature(Request $request)
    {
        $data['video_id'] = $_POST['featured_id'];

        $data['added_by'] = $request->user()->id;
        // dd($data);

        $this->featured->fill($data);
        $status = $this->featured->save();
        if ($status) {
            Session::flash('message','added successfully.');
        }else {
            Session::flash('eroor','Problem occured');
        }
        return redirect()->route('post.index');
    }

    public function unfeature()
    {
        $data['video_id'] = $_POST['featured_id'];
        // echo $data['featured_id'];
        $del = Featured::where([
            "video_id"=> $data['video_id'],
            "added_by"=> Auth::user()->id
            ])->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->video->find($id);
        if(!$data){
            Session::flash('error','video not found.');
            return redirect(route('video.index'));
        }
        $video_path = public_path('upload/fstv/video/'.$data->video);
        if(file_exists($video_path)){
           File::delete( $video_path);
        }
        $image_path = public_path('upload/fstv/video/'.$data->image);
        $thumb1 = public_path('upload/fstv/video/'.'Thumb-sm-'.$data->image);
        $thumb2 = public_path('upload/fstv/video/'.'Thumb-lg-'.$data->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);
            File::delete( $image_path);
        }
        $featured = Featured::where('video_id',$id)->first();
        if ($featured) {
            $featured->delete();
        }
         $popular = Popular::where('video_id',$id)->first();
        if ($popular) {
            $popular->delete();
        }
        $history = History::where('video_id',$id)->get();
        if ($history) {
           foreach($history as $item){
           	$item->delete();
          }
        }
        $device = Device::where('video_id',$id)->get();
        if ($device) {
            foreach($device as $item){
           	$item->delete();
          }
        }
        
        $status= $data->delete();
        if ($status) {
            Session::flash('message', "Video has been deleted successfully.");
            return redirect()->back();
        }
    }
}
