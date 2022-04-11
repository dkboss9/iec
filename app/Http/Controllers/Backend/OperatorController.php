<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Auth;
use Hash;
use File;
use Validator;
use Session;
use App\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Featured;
use App\Models\Popular;
use App\Models\HotNews;
use App\Models\Gallery;
use App\Models\Blog;
use App\Models\Operator;
use App\Models\Video;
use App\Models\Advertise;
use App\Models\UsersCategory;


class OperatorController extends Controller
{
    protected $user = null;
    protected $operator = null;
    public function __construct(User $user, Operator $operator)
    {
        $this->user = $user;
        $this->operator = $operator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('id','!=',request()->user()->id)->with('operator_info')->where('role','operator')->orderBy('id','desc')->paginate(10);
        foreach ($data as $value) {
            $ca = UsersCategory::where('operator_id',$value->operator_info['id'])->where('cat_id','!=',null)->with('cat_info')->get();
            foreach ($ca as $item) {
                $item->c = $item->cat_info['title'];
            }
            $value->categories = $ca;    

            $me = UsersCategory::where('operator_id',$value->operator_info['id'])->where('menu_id','!=',null)->with('menu_info')->get();
            foreach ($me as $item) {
                $item->m = $item->menu_info['title'];
            }
            $value->menu = $me;    
        }
        // dd($data);
        return view('admin.userlist.operator-list')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == 'admin') {
            return view('admin.userlist.operator-form');
        }else{
            Session::flash('message','Unauthorized access.');
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
        if (auth()->user()->role != 'admin') {
            Session::flash('message','Unauthorized access.');
            return redirect()->back();
        }
        $rules = $this->operator->Rules('add');
        $request->validate($rules);
        
        $data = $request->except('image');
        $data['password'] = Hash::make($request->password);
        $data['role']= 'operator';
        // dd($request,$data);
        $this->user->fill($data);
        $status = $this->user->save();

        if($status){
            if ($request->hasFile('image')) {
                $image = $request->image;
                $image_path = public_path("/upload/users/".$image);
                if(file_exists($image_path)){
                    File::delete($image_path);
                }

                $file_ext = $request->file('image');
                $file_name = time().'.'.$file_ext->getClientOriginalExtension();
                $file_ext->move(public_path('/upload/users/'), $file_name); 
                $data['image']= $file_name;
            }

            $data['added_by'] = $request->user()->id;
            $data['user_id'] = $this->user->id;

            $operator_info = new Operator();
            $operator_info->fill($data);
            $operator_info->save();
        
            $cat = $request->get('category');
            if ($cat) {
                foreach($cat as $id) {
                    UsersCategory::create([
                        'cat_id' => $id,
                        'operator_id' => $operator_info->id,
                        'user_id' => $this->user->id,
                    ]);
                }                
            }
            $menu = $request->get('menu');
            if ($menu) {
                foreach($menu as $id) {
                    UsersCategory::create([
                        'menu_id' => $id,
                        'operator_id' => $operator_info->id,
                        'user_id' => $this->user->id,
                    ]);
                }                
            }

            Session::flash('message','Operator has been added successfully.');
            return redirect()->route('operator.index');
        } else {
            Session::flash('error','Eror occured..');
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
        if (auth()->user()->role == 'admin') {
            $this->user = User::with('operator_info')->find($id);
            if(!$this->user){
                request()->session()->flash('error','User does not exists.');
                return redirect()->back();
            }
            $operator_id = $this->user->operator_info['id'];
            $operator = Operator::with('cat_info')->find($operator_id);
            $asociated_cats = UsersCategory::where('operator_id',$operator_id)->where('cat_id','!=',null)->pluck('cat_id')->toArray();
            $asociated_menu = UsersCategory::where('operator_id',$operator_id)->where('menu_id','!=',null)->pluck('menu_id')->toArray();
            // dd($operator_id);
            return view('admin.userlist.operator-form')->with('user_detail',$operator)
                ->with('men',$asociated_menu)
                ->with('ass',$asociated_cats);
        }else{
            Session::flash('message','Unauthorized access.');
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
        $this->user = $this->user->with('operator_info')->find($id);
        $operator_id = $this->user->operator_info['id'];
        $this->operator = $this->operator->with('info_user')->with('cat_info')->find($operator_id);
        // dd($this->operator, $request);
        
        $rules = $this->operator->updateRule('update');
        $request->validate($rules);
        $data = $request->except('image');
        $data['is_verified'] = $request->has('is_verified');
        $data['blog'] = $request->has('blog');
        $data['gallery'] = $request->has('gallery');
        $data['adver'] = $request->has('adver');
        // dd($request,$data);
        if(isset($request->change_password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $this->user->password;
        }
        $this->user->fill($data);
        $status = $this->user->save();

        if($status){
            if ($request->hasFile('image')) {
                $image = $this->user->user_info['image'];
                $image_path = public_path("/upload/users/".$image);
                if(file_exists($image_path)){
                    File::delete($image_path);
                }

                $file_ext = $request->file('image');
                $file_name = time().'.'.$file_ext->getClientOriginalExtension();
                $file_ext->move(public_path('/upload/users/'), $file_name); 
                $data['image']= $file_name;
            }

            $data['added_by'] = $request->user()->id;
            $data['user_id'] = $this->user->id;

            if(empty($this->operator)){
                $operator_info = new UserInfo();
            }               
            $this->operator->fill($data);
            $this->operator->save();
            
            if (auth()->user()->role == 'admin') {
                $a = UsersCategory::where('operator_id',$operator_id)->get();
                foreach ($a as $value) {
                    $value->delete();
                }

                $cat = $request->get('category');
                if ($cat) {
                    foreach($cat as $id) {
                        UsersCategory::create([
                            'cat_id' => $id,
                            'operator_id' => $this->operator->id,
                            'user_id' => $this->user->id,
                        ]);
                    }                    
                }
                $menu = $request->get('menu');
                if ($menu) {
                    foreach($menu as $id) {
                        UsersCategory::create([
                            'menu_id' => $id,
                            'operator_id' => $this->operator->id,
                            'user_id' => $this->user->id,
                        ]);
                    }                    
                }

                Session::flash('message', "Operator updated Successfully.");
                return redirect()->route('operator.index');
            }elseif (auth()->user()->role == 'operator') {
                Session::flash('message', "Operator updated Successfully.");
                return redirect()->route('profile');
            }

        } else {
            Session::flash('error','Eror occured..');
            return redirect()->back();
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
        if (auth()->user()->role == 'admin') {
            $user = $this->user->find($id);
            if(!$user){
                Session::flash('message','Operator was not found.');
                return redirect()->back();
            }
            $image = $user->operator_info['image'];
            $image_path = public_path("/upload/users/".$image);
            if(file_exists($image_path)){
                File::delete($image_path);
            }
            $status = $user->delete();
            if ($status) {
                Session::flash('message','Operator has been deleted successfully.');
                return redirect()->back();
            }
        }else{
            Session::flash('message','Unauthorized access.');
            return redirect()->back();
        }
    }

    public function publish_news()
    {
        $publish_news = Post::whereStatus('active')
        ->where('added_by',auth()->user()->id)
        ->orderBy('id','desc')->paginate(10);
        $featured = Featured::where("added_by", Auth::user()->id)->get()->toArray();
        $featured_post_id = array_column($featured,"post_id");
        
        $popular = Popular::where("added_by", Auth::user()->id)->get()->toArray();
        $popular_post_id = array_column($popular,"post_id");
       
        $hotNews = HotNews::where("added_by", Auth::user()->id)->get()->toArray();
        $hotNews_post_id = array_column($hotNews,"post_id");
        return view('operator.publish-post')
        ->with('featured_post_id', $featured_post_id)
        ->with('popular_post_id', $popular_post_id)
        ->with('hotNews_post_id', $hotNews_post_id)
        ->with('post_data',$publish_news);
    }

    public function publish_video()
    {
        $publish_video = Video::whereStatus('active')
        ->where('added_by',auth()->user()->id)
        ->orderBy('id','desc')->paginate(10);
        $featured = Featured::where("added_by", Auth::user()->id)->get()->toArray();
        $featured_video_id = array_column($featured,"video_id");
        
        $popular = Popular::where("added_by", Auth::user()->id)->get()->toArray();
        $popular_video_id = array_column($popular,"video_id");
        return view('operator.publish-video')
            ->with('popular_video_id', $popular_video_id)
            ->with('featured_video_id', $featured_video_id)
            ->with('data',$publish_video);
    }

    public function publish_blog()
    {
        $publish_blog = Blog::where('added_by', auth()->user()->id)->whereStatus('active')->orderBy('id','desc')->paginate(10);
        return view('operator.publish-blog')->with('blog_data',$publish_blog);
    }

    public function publish_gallery()
    {
        $publish_gallery = Gallery::where('added_by', auth()->user()->id)->whereStatus('active')->orderBy('id','desc')->paginate(10);
        return view('operator.publish-gallery')->with('gallery_data',$publish_gallery);
    }
    public function publish_advertise()
    {
        $publish_advertise = Advertise::where('added_by', auth()->user()->id)->whereStatus('active')->orderBy('id','desc')->paginate(10);
        return view('operator.publish-advertise')->with('advertise',$publish_advertise);
    }
}
