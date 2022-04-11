<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Advertise;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Support;
use App\Models\Favourite;
use App\Models\Contributor;
use App\Models\Review;
use App\Models\History;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Childmenu;
use App\Models\Video;
use Auth;

class ApiController extends Controller
{
    public function subcatsNews($sub_cat_id)
    {
        $news = Post::where('sub_cat_id', $sub_cat_id)->with('sub_cat_info')->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->paginate(5);
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);
        if (!$news->isempty()) {
            foreach($news AS $post){
                $post->imageurl = url("/upload/post/".$post['image']);
                if (Auth::guard('api')->check()){
                    logger(Auth::guard('api')->user()); // to get user
                    $fav = Favourite::where('added_by', auth('api')->user()->id)->where('post_id',$post['id'])->first();
                    if (isset($fav)) {
                        $post->favourite = "yes";
                            // return response()->json(['s']);
                    }else{
                        $post->favourite = "no";
                    }
                }
            }
            return response()->json([
                'news' => $news,
                'advertise' => $advertise,
            ]);
        }
    }
    public function newsDetail($id)
    {
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);
        
        $post = Post::with('sub_cat_info')->find($id);        
        if ($post) {
            $post->imageurl = url("/upload/post/".$post->image);
            if (isset($post->video)) {
                $post->videourl = url("/upload/post/".$post->video);
                
            }
            if (Auth::guard('api')->check()){
                logger(Auth::guard('api')->user()); // to get user
                $fav = Favourite::where('added_by', auth('api')->user()->id)->where('post_id',$id)->first();
                if (isset($fav)) {
                    $post->favourite = "yes";
                        // return response()->json(['s']);
                }else{
                    $post->favourite = "no";
                }
            }

            $recommend_post = Post::where('id', '!=' , $id)->with('cat_info')
            ->where(function ($query) {
                $query->where('date',null)
                      ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
            })->limit(4)->get();
            if (!$recommend_post->isempty()) {
                foreach($recommend_post AS $recommend_posts){
                    $recommend_posts->imageurl = url("/upload/post/".$recommend_posts['image']);
                }
            }
            $contributor = Contributor::where('id',$post->contributor_id)->first();
            if (isset($contributor)) {
                $contributor->imageurl = url("/upload/contributor/".$contributor->image);            
            }

            $reviews = Review::where('post_id',$id)->orderBy('id','desc')->get();
            if (Auth::guard('api')->check()){
                logger(Auth::guard('api')->user()); // to get user

                $history = History::where('user_id',auth('api')->user()->id)->where('post_id',$id)->first();
                if (isset($history)) {
                    $history->delete();
                    $data = new History();
                    $data['user_id'] = auth('api')->user()->id;
                    $data['post_id'] = $id;
                    $data->save();
                }else{
                    $data = new History();
                    $data['user_id'] = auth('api')->user()->id;
                    $data['post_id'] = $id;
                    $data->save();
                }
                
            }
            return response()->json([
                'advertise' =>$advertise,
                'post' =>$post,
                'recommend_posts' => $recommend_post,
                'contributor' => $contributor,
                'reviews' => $reviews,
            ]);
        }else{
            return response()->json(['message' => 'No post found.'], 401);
        }

    }

    public function reviewPost(Request $request, $post_id)
    {
        if (Auth::guard('api')->check()){
            logger(Auth::guard('api')->user()); // to get user
            $request->validate([
                'comments' => 'string|required',
            ]);
           
           $data= new Review();
            $data['name'] = auth('api')->user()->name;
            $data['post_id'] = $post_id;
            $data['comments'] = $request->comments;
            $status = $data->save();

            $review = Review::where('post_id',$post_id)->latest()->first();
            return response()->json([
                'review' => $review,
                'success' => 'Your support has been created successfully.',
            ]);
        }else{
            return response()->json([
                'message' => 'Invalid access token',
            ],401);
        }
    }
    
    public function contact()
    {
        $contact= Contact::orderBy('id','DESC')->first();
        return response()->json([
            'contact_detail'=>$contact,
            'app_link' => "http://firescreentv.com.au/",
        ]);
    }

    public function blog()
    {
        $blog = Blog::orderBY('id',"DESC")->paginate(10);
        if (!$blog->isempty()) {
            foreach($blog AS $blogs){
                $blogs->imageurl = url("/upload/blog/".$blogs['image']);
                if (Auth::guard('api')->check()){
                  logger(Auth::guard('api')->user()); // to get user
                  $fav = Favourite::where('added_by', auth('api')->user()->id)->where('blog_id',$blogs->id)->first();
                  if (isset($fav)) {
                      $blogs->favourite = "yes";
                          // return response()->json(['s']);
                  }else{
                      $blogs->favourite = "no";
                  }
              }
            }
          
        }
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);
        
        return response()->json([
            'blogs' => $blog,
            'advertise' => $advertise,
        ]);
    }
    public function blogDetail($id)
    {
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);
        $blog = Blog::find($id);
        if ($blog) {
            $blog->imageurl = url("/upload/blog/".$blog->image);
        }
      if (Auth::guard('api')->check()){
                    logger(Auth::guard('api')->user()); // to get user
                    $fav = Favourite::where('added_by', auth('api')->user()->id)->where('blog_id',$id)->first();
                    if (isset($fav)) {
                        $blog->favourite = "yes";
                            // return response()->json(['s']);
                    }else{
                        $blog->favourite = "no";
                    }
                }

        $recommend_blog = Blog::where('id', '!=' , $id)->paginate(10);
        if (!$recommend_blog->isempty()) {
            foreach($recommend_blog AS $recommend_blogs){
                $recommend_blogs->imageurl = url("/upload/post/".$recommend_blogs['image']);
            }
        }

        return response()->json([
            'blog_detail' => $blog,
            'advertise' => $advertise,
            'recommended_blogs' => $recommend_blog,
        ]);

    }

    public function support(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email|regex:/(.*)\.com/i',
            'name' => ['required', 'string', 'max:255'],
            'phone' => 'string|nullable',
            'comment' => 'string|required',
        ]);
       
        $data= $request->except('_token');
        $support = Support::create($data);
        return response()->json([
            'success' => 'Your support has been created successfully.',
        ]);
    }

    public function gallery()
    {
        $gallery = Gallery::orderBy('id','DESC')->get();
        foreach($gallery AS $post){
            $post->imageurl = url("/upload/gallery/".$post->image);
        }

        return response()->json([
            'gallery' =>$gallery,
        ]); 
        
    }

    public function search(Request $request)
    {
        if ($request->cat_id != null) {
            if ($request->from == null && $request->to == null && $request->search_text != null) { 
                $result=Post::where('cat_id', $request->cat_id)
                    ->where('title','LIKE','%'.$request->search_text.'%')
                    ->with('sub_cat_info')
                    ->where(function ($query) {
                        $query->where('date',null)
                              ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                    })->orderBy('id','desc')->paginate(10);
                    if ($result->count() == '0') {
                        return response()->json(['result'=>""], 200);
                    }else{
                        foreach($result AS $post){
                            if ($post['video'] != null) {
                                $post->imageurl = url("/upload/post/".$post['image']);
                                $post->videourl = url("/upload/post/video/".$post['video']);
                                
                            }else{
                                $post->imageurl = url("/upload/post/".$post['image']);
                              
                            }
                        }
                        return response()->json([
                            'result' => $result,
                        ]);              
                    }
            }elseif($request->from != null && $request->to != null && $request->search_text != null){
                $result = Post::where('cat_id', $request->cat_id)->where('cat_id',$request->cat_id)
                    ->where('title','LIKE','%'.$request->search_text.'%')
                    ->with('sub_cat_info')->whereBetween('created_at', [$request->from, $request->to])
                    ->where(function ($query) {
                        $query->where('date',null)
                              ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                    })->orderBy('id','DESC')->paginate(5);
                    if ($result->count() == '0') {
                        return response()->json(['result'=>""], 200);
                    }else{
                        foreach($result AS $post){
                            if ($post['video'] != null) {
                                $post->imageurl = url("/upload/post/".$post['image']);
                                $post->videourl = url("/upload/post/video/".$post['video']);
                               
                            }else{
                                $post->imageurl = url("/upload/post/".$post['image']);
                               
                            }
                        }
                        return response()->json([
                            'result' => $result,
                        ]);              
                    }
            }elseif($request->from != null && $request->to != null && $request->search_text == null){
                $result = Post::where('cat_id',$request->cat_id)->whereBetween('created_at', [$request->from, $request->to])
                ->with('sub_cat_info')->where(function ($query) {
                    $query->where('date',null)
                          ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                })->orderBy('id','DESC')->paginate(5);
                if ($result->count() == '0') {
                    return response()->json(['result'=>""], 200);
                }else{
                    foreach($result AS $post){
                        if ($post['video'] != null) {
                            $post->imageurl = url("/upload/post/".$post['image']);
                            $post->videourl = url("/upload/post/video/".$post['video']);
                          
                        }else{
                            $post->imageurl = url("/upload/post/".$post['image']);
                          
                        }
                    }
                    return response()->json([
                        'result' => $result,
                    ]);              
                }
            }elseif($request->from == null && $request->to == null && $request->search_text == null){
                $result=Post::where('cat_id', $request->cat_id)
                    ->with('sub_cat_info')->where(function ($query) {
                        $query->where('date',null)
                              ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                    })->orderBy('id','desc')->paginate(10);
                    if ($result->count() == '0') {
                        return response()->json(['result'=>""], 200);
                    }else{
                        foreach($result AS $post){
                            if ($post['video'] != null) {
                                $post->imageurl = url("/upload/post/".$post['image']);
                                $post->videourl = url("/upload/post/video/".$post['video']);
                              
                            }else{
                                $post->imageurl = url("/upload/post/".$post['image']);
                               
                            }
                        }
                        return response()->json([
                            'result' => $result,
                        ]);              
                    }
            }

        }else{            
            if($request->from == null && $request->to == null && $request->search_text != null){
                // $result = Post::where('title','LIKE','%'.$request->search_text.'%')->orderBy('id','DESC')->paginate(5);
    
                $result1 = Post::where('title','LIKE','%'.$request->search_text.'%')->with('sub_cat_info')
                ->where(function ($query) {
                    $query->where('date',null)
                          ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                })->orderBy('id','desc')->paginate(10);
                $result = $result1;
    
                if ($result->count() == '0') {
                    return response()->json(['result'=>""], 200);
                }else{
                    foreach($result AS $post){
                        if ($post['video'] != null) {
                            $post->imageurl = url("/upload/post/".$post['image']);
                            $post->videourl = url("/upload/post/video/".$post['video']);
                           
                        }else{
                            $post->imageurl = url("/upload/post/".$post['image']);
                            
                        }
                    }
                    return response()->json([
                        'result' => $result,
                    ]);              
                } 
    
            }elseif($request->search_text == null && $request->from != null && $request->to != null ){
                $result = Post::whereBetween('created_at', [$request->from, $request->to])->with('sub_cat_info')
                ->where(function ($query) {
                    $query->where('date',null)
                          ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                })->orderBy('id','DESC')->paginate(5);
    
                if ($result->count() == '0') {
                    return response()->json(['result'=>""], 200);
                }else{
                    foreach($result AS $post){
                        if ($post['video'] != null) {
                            $post->imageurl = url("/upload/post/".$post['image']);
                            $post->videourl = url("/upload/post/video/".$post['video']);
                           
                        }else{
                            $post->imageurl = url("/upload/post/".$post['image']);
                           
                        }
                    }
                    return response()->json([
                        'result' => $result,
                    ]);              
                } 
            }elseif($request->search_text != null && $request->from != null && $request->to != null ){
                $result = Post::where('title','LIKE','%'.$request->search_text.'%')->whereBetween('created_at', [$request->from, $request->to])
                  ->with('sub_cat_info')
                  ->where(function ($query) {
                    $query->where('date',null)
                          ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                })->orderBy('id','DESC')->paginate(5);
    
                if ($result->count() == '0') {
                    return response()->json(['result'=>""], 200);
                }else{
                    foreach($result AS $post){
                        if ($post['video'] != null) {
                            $post->imageurl = url("/upload/post/".$post['image']);
                            $post->videourl = url("/upload/post/video/".$post['video']);
                           
                        }else{
                            $post->imageurl = url("/upload/post/".$post['image']);
                           
                        }
                    }
                    return response()->json([
                        'result' => $result,
                    ]);              
                } 
            }else{
                return response()->json([
                    'result'=> 'Invalid search',
                ]);
            }
        }
    }

    public function media()
    {
       $category = Menu::where('status','active')->get();
       return response()->json([
           'category'=> $category,
       ]);
    }

    public function trendingmedia(Request $request)
    {
        $videos = Video::where('is_trending',1)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','desc')->paginate(10);
        if (isset($videos)) {
            foreach ($videos as $video) {
                $video->video_path = url("/upload/fstv/video/".$video['video']);
                $video->thumbnail_path = url("/upload/fstv/video/".$video['image']);
                $video->video_link = url($video['link']);
            }
            return response()->json([                
                'videos' => $videos,
            ]);
        }
    }

    public function mediaCategory(Request $request, $menu_id)
    {
        $category = Menu::where('id',$menu_id)->where('status','active')->get();
        $subcats = Submenu::where('status','active')->where('menu_id', $menu_id)->orderBy('id','asc')->paginate(10);
        $vid = Video::where('menu_id',$menu_id)->where('submenu_id',null)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->get();
        foreach ($vid as $item) {
            $item->thumbnail_path = url("/upload/fstv/video/".$item['image']);
        }
        
        if ($category && !$subcats->isempty()) {
            foreach($subcats AS $subcat){
                $subcat->sub_category = $subcat->title;

                $sub_videos = Video::where('status','active')->where('childmenu_id',null)->where('menu_id', $menu_id)
                ->where('submenu_id',$subcat->id)
                ->where(function ($query) {
                    $query->where('date',null)
                          ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                })->limit(4)->get();
                foreach ($sub_videos as $video) {
                    $video->video_path = url("/upload/fstv/video/".$video['video']);
                    $video->thumbnail_path = url("/upload/fstv/video/".$video['image']);
                    $video->video_link = url($video['link']);
                }
                $subcat->videos = $sub_videos;  

                $childcat = Childmenu::where('menu_id', $menu_id)->where('submenu_id', $subcat->id)->where('status','active')->limit(6)->get();
                if (isset($childcat)) {
                    foreach ($childcat as $child) {
                        $child->thumbnail_path = url("/upload/fstv/childmenu/".$child['image']);
                    }
                    $subcat->childcat = $childcat; 
                }
                 
            }
            return response()->json([                
                'category' => $category,
                'subcats' => $subcats,
                'video' => $vid,
            ]);
        }else{
            return response()->json([                
                'category' => $category,
                'subcats' => $subcats,
                'video' => $vid,
            ]);
        }
    }

    public function mediaSubcat(Request $request, $submenu_id)
    {
        $submenu = Submenu::find($submenu_id);
        if ($submenu) {
            $menu_id = $submenu->menu_id;

            $sub_vid = Video::where('submenu_id',$submenu_id)
                ->where('status','active')
                ->where('menu_id',$menu_id)
                ->with('childmenu_info')
                ->where(function ($query) {
                    $query->where('date',null)
                          ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
                })->orderBy('id','desc')->paginate(10);
            foreach ($sub_vid as $item) {
                $item->thumbnail_path = url("/upload/fstv/video/".$item['image']);
            }

            $childmenu = Childmenu::where('menu_id',$menu_id)->where('submenu_id',$submenu_id)->where('status','active')->paginate(10);
            if (isset($childmenu)) {
                foreach ($childmenu as $child) {
                    $child->thumbnail_path = url("/upload/fstv/video/".$child['image']);
                }
            }
            // $childmenu->videos = "j";
            return response()->json([
                'submenu' => $submenu->title,
                'childmenu' => $childmenu,
                'submenu_list' => $sub_vid,
            ]);
        }
    }

    public function childMedialist(Request $request, $childmenu_id)
    {
        $childmenu = Childmenu::find($childmenu_id);
        $childmenu->thumbnail_path = url("/upload/fstv/childmenu/".$childmenu['image']);

        if ($childmenu) {
            $videos = Video::where('childmenu_id',$childmenu_id)->where('menu_id',$childmenu->menu_id)
            ->where('status','active')
            ->where(function ($query) {
                $query->where('date',null)
                      ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
            })->get();
            foreach ($videos as $video) {
                $video->thumbnail_path = url("/upload/fstv/video/".$video['image']);
            }
        }
        return response()->json([
            'childmenu' => $childmenu,
            'videos' => $videos,
        ]);
    }

    public function videoDetail($id)
    {
        $video =  Video::find($id);
        if ($video) {
            // $video->detail = strip_tags(preg_replace(array('<p>','</p>'), '', html_entity_decode($video->detail))) ;
            $video->detail = strip_tags(html_entity_decode($video->detail));
            // $video->d=$video->detail;
            $video->videourl = url("/upload/fstv/video/".$video->video);
            $video->thumbnail_path = url("/upload/fstv/video/".$video->image);
            $video->video_link = url($video->link);
        }
        $childmenu_id = $video->childmenu_id;

        if (isset($childmenu_id)) {
            $recommend = Video::where('id','!=',$id)->where('status','active')->where('childmenu_id',$childmenu_id)->limit(4)->get();
            foreach ($recommend as $recom) {
                $recom->thumbnail_path = url("/upload/fstv/video/".$recom->image);
            }
            if ($recommend->count() < 1) {
                $recommend = Video::where('id','!=',$id)->where('status','active')->get()->random(4);
                foreach ($recommend as $recom) {
                    $recom->thumbnail_path = url("/upload/fstv/video/".$recom->image);
                }
            }
        }else{
            $recommend = Video::where('id','!=',$id)->where('status','active')->get()->random(4);
            foreach ($recommend as $recom) {
                $recom->thumbnail_path = url("/upload/fstv/video/".$recom->image);
            }
        }
    
        if (Auth::guard('api')->check()){
            logger(Auth::guard('api')->user()); // to get user
            
            $history = History::where('user_id',auth('api')->user()->id)->where('video_id',$id)->first();
            if (isset($history)) {
                $history->delete();
                $data = new History();
                $data['user_id'] = auth('api')->user()->id;
                $data['video_id'] = $id;
                $data->save();
            }else{
                $data = new History();
                $data['user_id'] = auth('api')->user()->id;
                $data['video_id'] = $id;
                $data->save();
            }
        }

        return response()->json([
            'video' => $video,
            'recommend_video' => $recommend,
        ]);
    }

    public function watchNewsHistory()
    {
        if (Auth::guard('api')->check()){
            logger(Auth::guard('api')->user()); // to get user
            
            $history = History::where('user_id',auth('api')->user()->id)->where('video_id',null)->with('post_info')->orderBy('id','desc')->paginate(10);
            if (isset($history)) {
                foreach ($history as $news) {
                    $news->post_thumbnail_url = url("/upload/post/".$news->post_info['image']);
                }
            }
           
            return response()->json([
                'history' => $history,
            ]);
        }else{
            return response()->json([
                'message' => 'Invalid access token',
            ],401);
        }
    }

    public function watchMediaHistory()
    {
        if (Auth::guard('api')->check()){
            logger(Auth::guard('api')->user()); // to get user
            
            $history = History::where('user_id',auth('api')->user()->id)->where('post_id',null)->with('video_info')->orderBy('id','desc')->paginate(10);
            if (isset($history)) {
                foreach ($history as $video) {
                    $video->video_thumbnail_url = url("/upload/fstv/video/".$video->video_info['image']);
                    $video->video_sub_category = $video->video_info['sub_cat_info'];
                }
            }
           
            return response()->json([
                'history' => $history,
            ]);
        }else{
            return response()->json([
                'message' => 'Invalid access token',
            ],401);
        }
    }
      
    public function newsHistoryFilter(Request $request)
    {
        if (Auth::guard('api')->check()){
            logger(Auth::guard('api')->user()); // to get user
            
            if ($request->from == null && $request->to == null && $request->cat_id != null) {
                if ($request->cat_id) {
                    $cat_id = $request->cat_id;

                    $history = History::where('user_id',auth('api')->user()->id)
                        ->where('video_id',null)
                        ->with('post_info')
                        ->whereHas('post_info', function($query) use ($cat_id) {
                            $query->where('cat_id',$cat_id);
                        })->orderBy('id','desc')->paginate(10);
                    
                    if (isset($history)) {
                        foreach ($history as $post) {
                            $post->post_thumbnail_url = url("/upload/post/".$post->post_info['image']);
                        }
                    }
                    return response()->json([
                        'history' => $history,
                    ]);                    
                }else{
                    return response()->json([
                        'message' => 'No result found',
                    ],401);
                }
            }elseif($request->from != null && $request->to != null && $request->cat_id == null){
                
                $history = History::where('user_id',auth('api')->user()->id)
                    ->whereBetween('created_at', [$request->from, $request->to])
                    ->where('video_id',null)
                    ->with('post_info')
                    ->orderBy('id','DESC')->paginate(10);
               
                if (isset($history)) {
                    foreach ($history as $post) {
                        $post->post_thumbnail_url = url("/upload/post/".$post->post_info['image']);
                    }
                }
                return response()->json([
                    'history' => $history,
                ]);    
                
            }elseif($request->from != null && $request->to != null && $request->cat_id != null){
                $cat_id = $request->cat_id;

                $history = History::where('user_id',auth('api')->user()->id)
                    ->whereBetween('created_at', [$request->from, $request->to])
                    ->where('video_id',null)
                    ->with('post_info')
                    ->whereHas('post_info', function($query) use ($cat_id) {
                        $query->where('cat_id',$cat_id);
                    })->orderBy('id','desc')->paginate(10);
                    
                if (isset($history)) {
                    foreach ($history as $post) {
                        $post->post_thumbnail_url = url("/upload/post/".$post->post_info['image']);
                    }
                }
                return response()->json([
                    'history' => $history,
                ]);    
            }
            
        }else{
            return response()->json([
                'message' => 'Invalid access token',
            ],401);
        }
        
    }

    public function mediaHistoryFilter(Request $request)
    {
        if (Auth::guard('api')->check()){
            logger(Auth::guard('api')->user()); // to get user
            
            if ($request->from == null && $request->to == null && $request->menu_id != null) {
                if ($request->menu_id) {
                    $menu_id = $request->menu_id;

                    $history = History::where('user_id',auth('api')->user()->id)
                        ->where('post_id',null)
                        ->with('video_info')
                        ->whereHas('video_info', function($query) use ($menu_id) {
                            $query->where('menu_id',$menu_id);
                        })->orderBy('id','desc')->paginate(10);

                    if (isset($history)) {
                        foreach ($history as $video) {
                            $video->video_thumbnail_url = url("/upload/fstv/video/".$video->video_info['image']);
                        }
                    }
                    return response()->json([
                        'history' => $history,
                    ]);                    
                }else{
                    return response()->json([
                        'message' => 'No result found',
                    ],401);
                }
            }elseif($request->from != null && $request->to != null && $request->menu_id == null){
                
                $history = History::where('user_id',auth('api')->user()->id)
                    ->whereBetween('created_at', [$request->from, $request->to])
                    ->where('post_id',null)
                    ->with('video_info')
                    ->orderBy('id','DESC')->paginate(10);
                
                if (isset($history)) {
                    foreach ($history as $video) {
                        $video->video_thumbnail_url = url("/upload/fstv/video/".$video->video_info['image']);
                    }
                }
                return response()->json([
                    'history' => $history,
                ]);    
                
            }elseif($request->from != null && $request->to != null && $request->menu_id != null){
                $menu_id = $request->menu_id;

                $history = History::where('user_id',auth('api')->user()->id)
                    ->whereBetween('created_at', [$request->from, $request->to])
                    ->where('post_id',null)
                    ->with('video_info')
                    ->whereHas('video_info', function($query) use ($menu_id) {
                        $query->where('menu_id',$menu_id);
                    })->orderBy('id','desc')->paginate(10);
                
                if (isset($history)) {
                    foreach ($history as $video) {
                        $video->video_thumbnail_url = url("/upload/fstv/video/".$video->video_info['image']);
                    }
                }
                return response()->json([
                    'history' => $history,
                ]);    
            }
            
        }else{
            return response()->json([
                'message' => 'Invalid access token',
            ],401);
        }
        
    }
    
}
