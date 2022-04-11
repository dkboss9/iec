<?php
namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Featured;
use App\Models\Popular;
use App\Models\HotNews;
use App\Models\Contributor;
use App\Models\UsersCategory;
use App\Device;
use App\Models\Author;
use App\Models\History;
use App\Models\Review;
use File;
use DB;
use Auth;
use Image;
use Session;
use Carbon\Carbon;
// use FFMpeg\FFMpeg;


class PostController extends Controller
{
    protected $post =null ;
    protected $category =null ;
    protected $featured =null ;
    protected $popular =null ;
    protected $hotNews =null ;
    protected $review =null ;
    protected $author =null ;
    protected $contributor =null ;
    public function __construct(Post $post, Category $category, Author $author, Contributor $contributor, Featured $featured, Popular $popular, HotNews $hotNews, Review $review)
    {
        $this->post = $post;
        $this->contributor = $contributor;
        $this->author = $author;
        $this->category = $category;
        $this->review = $review;
        $this->popular = $popular;
        $this->hotNews = $hotNews;
        $this->featured = $featured;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getFeaturedPosts(){
    //     $feature = Featured::orderBy('id','DESC')->get();      
    //     return view('frontend.featured')->with('featured', $feature);
    // }
    public function index()
    {
        // $featured = Featured::where("added_by", Auth::user()->id)->get()->toArray();
        // $featured_post_id = array_column($featured,"post_id");
        
        // $popular = Popular::where("added_by", Auth::user()->id)->get()->toArray();
        // $popular_post_id = array_column($popular,"post_id");
       
        // $hotNews = HotNews::where("added_by", Auth::user()->id)->get()->toArray();
        // $hotNews_post_id = array_column($hotNews,"post_id");
        // dd($featured_post_id);
        if (auth()->user()->role == 'admin') {
            $posts = $this->post->with(['cat_info','sub_cat_info','images'])->orderBy('id','Desc')->get();
            $featured = Featured::where("added_by", '!=', null)->get()->toArray();
            $featured_post_id = array_column($featured,"post_id");
            
            $popular = Popular::where("added_by", '!=', null)->get()->toArray();
            $popular_post_id = array_column($popular,"post_id");
        
            $hotNews = HotNews::where("added_by", '!=', null)->get()->toArray();
            $hotNews_post_id = array_column($hotNews,"post_id");

            return view('admin.post')
                ->with('featured_post_id', $featured_post_id)
                ->with('popular_post_id', $popular_post_id)
                ->with('hotNews_post_id', $hotNews_post_id)
                ->with('post_data',$posts);           
        }elseif (auth()->user()->role == 'editor') {
            $posts = $this->post->where('added_by',auth()->user()->id)
            ->whereStatus('inactive')
            ->with(['cat_info','sub_cat_info','images'])
            ->orderBy('id','Desc')->get();

            $p = array_column($posts->toArray(),'id');
            
            $featured = Featured::whereIn("post_id", $p)->get()->toArray();
            $featured_post_id = array_column($featured,"post_id");
            $popular = Popular::whereIn("post_id", $p)->get()->toArray();
            $popular_post_id = array_column($popular,"post_id");
            $hotNews = HotNews::whereIn("post_id", $p)->get()->toArray();
            $hotNews_post_id = array_column($hotNews,"post_id");
            
            return view('editor.post')
                ->with('featured_post_id', $featured_post_id)
                ->with('popular_post_id', $popular_post_id)
                ->with('hotNews_post_id', $hotNews_post_id)
                ->with('post_data',$posts);
        }elseif (auth()->user()->role == 'operator') {
            $posts = $this->post->where('added_by',auth()->user()->id)
            ->whereStatus('inactive')
            ->with(['cat_info','sub_cat_info','images'])
            ->orderBy('id','Desc')->get();

            $p = array_column($posts->toArray(),'id');
            
            $featured = Featured::whereIn("post_id", $p)->get()->toArray();
            $featured_post_id = array_column($featured,"post_id");
            $popular = Popular::whereIn("post_id", $p)->get()->toArray();
            $popular_post_id = array_column($popular,"post_id");
            // dd($p,$popular_post_id,$popular);
            $hotNews = HotNews::whereIn("post_id", $p)->get()->toArray();
            $hotNews_post_id = array_column($hotNews,"post_id");

            return view('operator.post')
                ->with('featured_post_id', $featured_post_id)
                ->with('popular_post_id', $popular_post_id)
                ->with('hotNews_post_id', $hotNews_post_id)
                ->with('post_data',$posts);
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
            $this->category = $this->category->where('status','active')->where('parent_id', null)->pluck('title','id');
            return view('admin.post-form')->with('parent_cats',$this->category);

        }elseif (Auth::user()->role == 'editor') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('cat_id','!=',null)->pluck('cat_id')->toArray();
            if ($ca != null) {
                $this->category = $this->category->whereIn('id',$ca)->where('status','active')->where('parent_id', null)->pluck('title','id');
                return view('editor.post-form')->with('parent_cats',$this->category);
            }else{
                Session::flash('error','You do not have access to add post.');
                return redirect()->back();
            }
        
        }elseif (Auth::user()->role == 'operator') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('cat_id','!=',null)->pluck('cat_id')->toArray();
            if ($ca != null) {
                $this->category = $this->category->whereIn('id',$ca)->where('status','active')->where('parent_id', null)->pluck('title','id');
                return view('operator.post-form')->with('parent_cats',$this->category);
            }else{
                Session::flash('error','You do not have access to add post.');
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }

        $contributor_info = $this->contributor->pluck('name','id');
        $author_info = $this->author->pluck('name','id');
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
        $rules = $this->post->rules();
        $request->validate($rules);

        $data = $request->except(['is_trending','image','video']);
        $data['is_trending'] = $request->has('is_trending');
        // $data['detail'] = htmlentities($request->detail);
        $data['added_by'] = $request->user()->id;

        if ($request->hasfile('video')) {
            $file_ext = $request->file('video');
            $file_name = $request->file('video')->getClientOriginalName();
            $file_ext->move(public_path('upload/post/video/'), $file_name);           
            $data['video']= $file_name;
        }
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/post/'), $file_name,60);           
            $data['image']= $file_name;

            Image::make(public_path('upload/post').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/post').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/post').'/'.$file_name)->resize(null, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/post').'/Thumb-lg-'.$file_name,60);            
        }
        
        // dd($data);
        $this->post->fill($data);
        $status = $this->post->save();
    
        if ($status) {
            $post_id = $this->post->id;
            $cat_id = $this->post->cat_id;
            $active = $this->post->status;
            
            if ($this->post->status == 'active' && $this->post->date <= Carbon::today()->format('Y-m-d') ) {
                $ch = Device::where('status','yes')->where('cat_id',$cat_id)
                ->where('post_id',null)
                ->where('voter_id',null)
                ->where('quiz_id',null)
                ->where('video_id',null)->get();
                foreach ($ch as $row) {
                    if ($row->cat_id == $cat_id) {
                        $data = new Device();
                            $data['token'] = $row->token;
                            $data['status'] = $row->status;
                            $data['post_id'] = $post_id;
                            $n =$data->save();                     
    
                        $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
                        
                      //  $check = Device::where('status','yes')->where('cat_id',null)->where('post_id', $post_id)->where('video_id',null)->get();
                        // dd($check,$ch,$row->cat_id,$cat_id); die();
                       // foreach ($check as $item) {
                          
                            $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $row->token);
                            $singleID = $notification['device_token'];
                            // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
                            if($notification['device_token'] != "" ){
                                #prep the bundle
                                $msg = array
                                    (
                                    'body' 	=> $this->post->title,
                                    'title'	=> 'FSTV posted new News.',
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
                                                "news_detail" => $this->post->id,
                                                "video_detail" => '',
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
            
            Session::flash('message', "Post has been added successfully.");
            return redirect(route('post.index'));
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
        $this->post = $this->post->find($id);
        if (Auth::user()->role == 'admin' &&  Auth::user()->status == 'active') {
            $this->category = $this->category->where('is_parent',1)->where('parent_id', null)->pluck('title','id');
            return view('admin.post-form')
            ->with('post_detail',$this->post)
            ->with('parent_cats',$this->category);
        }elseif (Auth::user()->role == 'editor' &&  $this->post->status == 'inactive') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('cat_id','!=',null)->pluck('cat_id')->toArray();
            $this->category = $this->category->whereIn('id',$ca)->where('is_parent',1)->where('parent_id', null)->pluck('title','id');
            return view('editor.post-form')
            ->with('post_detail',$this->post)
            ->with('parent_cats',$this->category);
        
        }elseif (Auth::user()->role == 'operator' &&  $this->post->status == 'inactive') {
            $ca = UsersCategory::where('user_id',auth()->user()->id)->where('cat_id','!=',null)->pluck('cat_id')->toArray();
            $this->category = $this->category->whereIn('id',$ca)->where('is_parent',1)->where('parent_id', null)->pluck('title','id');
            return view('operator.post-form')
            ->with('post_detail',$this->post)
            ->with('parent_cats',$this->category);

        }else{
            return redirect()->back();
        }
        $contributor_info = $this->contributor->pluck('name','id');
        $author_info = $this->author->pluck('name','id');
       
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
        $this->post = $this->post->with('images')->find($id);
        if(!$this->post){
            request()->session()->flash('error','Post not found.');
            return redirect(route('post.index'));
        }

        $rules = $this->post->rules('update');
        $request->validate($rules);
        $data = $request->except(['is_trending','image','video']);
        $data['is_trending'] = $request->has('is_trending');
        // $data['detail'] = htmlentities($request->detail);

        if ($request->hasfile('video')) {
            $file_ext = $request->file('video');
            $file_name = $request->file('video')->getClientOriginalName();
            $file_ext->move(public_path('upload/post/video/'), $file_name);           
            $data['video']= $file_name;

            File::delete($this->post->video);

            $video_path = public_path('upload/post/video/'.$this->post->video);
            if(file_exists($video_path)){
                File::delete( $video_path); 
            } 

        }
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/post/'), $file_name,60);           
            $data['image']= $file_name;

            File::delete($this->post->image);

            Image::make(public_path('upload/post').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/post').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/post').'/'.$file_name)->resize(null, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/post').'/Thumb-lg-'.$file_name,60);

            $image_path = public_path('upload/post/'.$this->post->image);
            $thumb1 = public_path('upload/post/'.'Thumb-sm-'.$this->post->image);
            $thumb2 = public_path('upload/post/'.'Thumb-lg-'.$this->post->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        $this->post->fill($data);
        
        $status = $this->post->save();
        if ($status) {
            $post_id = $this->post->id;
            $cat_id = $this->post->cat_id;
            $active = $this->post->status;
          	
          $already = Device::where('post_id',$post_id)->get();
          foreach($already as $item){
            $item->delete();
          }
            
            if ($this->post->status == 'active' && $this->post->date <= Carbon::today()->format('Y-m-d')) {
                $ch = Device::where('status','yes')->where('cat_id',$cat_id)
                ->where('post_id',null)
                ->where('voter_id',null)
                ->where('quiz_id',null)
                ->where('video_id',null)->get();
                foreach ($ch as $row) {
                    if ($row->cat_id == $cat_id) {
                        	$data = new Device();
                            $data['token'] = $row->token;
                            $data['status'] = $row->status;
                            $data['post_id'] = $post_id;
                            $n =$data->save();                    
    
                        $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
                        
                       // $check = Device::where('status','yes')->where('cat_id',null)->where('post_id', $post_id)->where('video_id',null)->get();
                        // dd($check,$ch,$row->cat_id,$cat_id); die();
                       // foreach ($check as $item) {
                          
                            $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $row->token);
                            $singleID = $notification['device_token'];
                            // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
                            if($notification['device_token'] != "" ){
                                #prep the bundle
                                $msg = array
                                    (
                                    'body' 	=> $this->post->title,
                                    'title'	=> 'FSTV updated a News.',
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
                                                "news_detail" => $this->post->id,
                                                "video_detail" => '',
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
            
            Session::flash('message', "Post has been updated successfully.");
            return redirect(route('post.index'));
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
        $post = $this->post->find($id);
        if(!$post){
            request()->session()->flash('error','post not found.');
            return redirect(route('post.index'));
        }

        $image_path = public_path('upload/post/'.$post->image);       
        $video_path = public_path('upload/post/video'.$post->video);       
        $thumb1 = public_path('upload/post/'.'Thumb-sm-'.$post->image);
        $thumb2 = public_path('upload/post/'.'Thumb-lg-'.$post->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);          
            File::delete($video_path);          
            File::delete( $image_path);                   
        }
        $featured = Featured::where('post_id',$id)->first();
        $popular = Popular::where('post_id',$id)->first();
        if ($featured) {
            $featured->delete();
        }
        if ($popular) {
            $popular->delete();
        }
        $history = History::where('post_id',$id)->get();
        if ($history) { 
          foreach($history as $item){
           	$item->delete();
          }
        }
        $device = Device::where('post_id',$id)->get();
        if ($device != null) {
            foreach($device as $item){
           	$item->delete();
          }
        }
       
        $status = $post->delete();
        if ($status) {
            Session::flash('message', "Post has been deleted successfully.");
            return redirect()->back();
        }
    }

    public function feature(Request $request)
    {
        $data['post_id'] = $_POST['featured_id'];
        $data['added_by'] = $request->user()->id;     
        
        $this->featured->fill($data);
        $status = $this->featured->save();
        if ($status) {
            Session::flash('message','added successfully');
        }else {
            Session::flash('eroor','Problem occured');
        }
        return redirect()->route('post.index');
    }

    public function unfeature()
    {
        $data['post_id'] = $_POST['featured_id'];
        // echo $data['featured_id'];
        if (auth()->user()->role != 'admin') {
            $del = Featured::where([
                "post_id"=> $data['post_id'],
                "added_by"=> Auth::user()->id
                ])->delete();        
        }else{
            $del = Featured::where([
                "post_id"=> $data['post_id'],
                ])->delete();  
        }
    }

    public function popular(Request $request)
    {
        $data['post_id'] = $_POST['popular_id'];        
        $data['added_by'] = $request->user()->id;

        $this->popular->fill($data);
        $status = $this->popular->save();
        if ($status) {
            Session::flash('message','added successfully');
        }else {
            Session::flash('eroor','Problem occured');
        }
        return redirect()->route('post.index');
    }

    public function unpopular()
    {
        $data['post_id'] = $_POST['popular_id'];
        // echo $data['popular_id'];
        if (auth()->user()->role != 'admin') {
            $del = Popular::where([
                "post_id"=> $data['post_id'],
                "added_by"=> Auth::user()->id
                ])->delete();       
        }else{
            $del = Popular::where([
                "post_id"=> $data['post_id'],
                ])->delete();  
        }       
    }

    public function hotNews(Request $request)
    {
        $data['post_id'] = $_POST['hotNews_id'];        
        $data['added_by'] = $request->user()->id;
       
        $this->hotNews->fill($data);
        $status = $this->hotNews->save();
        if ($status) {
            Session::flash('message','added successfully');
        }else {
            Session::flash('eroor','Problem occured');
        }
        return redirect()->route('post.index');
    }

    public function onHotnews()
    {
        $data['post_id'] = $_POST['hotNews_id'];
        // echo $data['hotNews_id'];
        if (auth()->user()->role != 'admin') {
            $del = HotNews::where([
                "post_id"=> $data['post_id'],
                "added_by"=> Auth::user()->id
                ])->delete();           
        }else{
            $del = HotNews::where([
                "post_id"=> $data['post_id'],
                ])->delete();  
        }    
    }

    public function getTrendingPosts()
    {
        $trending = Post::where('status','active')->where('is_trending', 1)->orderBy('id','DESC')->get();      
        return view('frontend.trending')->with('trending', $trending);
    }
    
    public function mostwatch(Request $request)
    {
        $data['post_id'] = $_POST['hotNews_id'];        
        $data['added_by'] = $request->user()->id;
       
        $this->hotNews->fill($data);
        $status = $this->hotNews->save();
        if ($status) {
            Session::flash('message','added successfully');
        }else {
            Session::flash('eroor','Problem occured');
        }
        return redirect()->route('post.index');
    }

    public function unwatch()
    {
        $data['post_id'] = $_POST['hotNews_id'];
        // echo $data['hotNews_id'];
        $del = Featured::where([
            "post_id"=> $data['post_id'],
            "added_by"=> Auth::user()->id
            ])->delete();        
    }

    public function submitReview(Request $request, $id)
    {
        // dd($request, $id);
        $data = $request->except(['post_id','_token']);

        $request->validate([
            'name' => 'string|required',
            'email' => 'string|required|email',
            'comments' => 'string|required',
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);

        // $post = Post::where('id', $id)->first();
        $data['post_id']= $id;
        $this->review->fill($data);
        $this->review->save();
        
        return redirect()->back();
    }

    public function search(Request $request)
    {  
        // dd($request);     
        $search_text = $_GET['search'];

        $category = Category::whereStatus('active')->where('title','LIKE','%'.$search_text.'%')->get();        
        $posts = Post::whereStatus('active')->where('title','LIKE','%'.$search_text.'%')->get();
        
        $result = $posts->union($category);
        // dd($result);
       
        return view('frontend.search')->with('result', $result);       
        
    }
}
