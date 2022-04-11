<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;
use App\Models\Video;
use App\Models\Advertise;
use App\Models\Popular;
use App\Models\HotNews;
use App\Models\Favourite;
use App\Models\Featured;
use Auth;
use DB;
use Carbon\Carbon;


class UserController extends Controller
{
    public function breakingNews()
    {
        $breakingnews = Post::where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->pluck('title');
        if (!$breakingnews->isempty()) {
            if (isset($breakingnews) && count($breakingnews) > 3) {
                return response()->json([
                    'breaking_news' => $breakingnews,
                ]);
            }
        }else{
            return response()->json(['error' => 'There are no any breaking news right now.'], 401);
        }
        
    }

    public function advertise()
    {
        $advertise = Advertise::where('position','content')->get();
        if (!$advertise->isempty()) {
            if (isset($advertise) && count($advertise) > 1) {
                foreach($advertise AS $ads){
                    $ads->imageurl = url("/upload/advertise/".$ads->ads_info['image']);
                }
            }else{
                $advertise->imageurl = url("/upload/advertise/".$advertise->image);
            }

            return response()->json([
                'advertise' => $advertise,
            ]);
        }else{
            return response()->json(['error'=>'There is no any advertise right now.'],401);
        }

    }
    public function dashboard()
    {
        $breakingnews = Post::where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);
        // foreach($advertise AS $post){
        //     $post->imageurl = url("/upload/advertise/".$post->image);
        // }       
        $category = Category::where('status','active')
            ->where('parent_id',null)
            ->orderBy('id','ASC')->get();

        $hotnews = HotNews::with('post_info')->orderBy('id','DESC')->paginate(5);
        foreach($hotnews AS $post){
            $post->imageurl = url("/upload/post/".$post->post_info['image']);
            $post->sub_cat_id = @$post->post_info->sub_cat_info['id'];
          	$post->sub_category = @$post->post_info->sub_cat_info['title'];

            if (Auth::guard('api')->check()){
                logger(Auth::guard('api')->user()); // to get user
                $fav = Favourite::where('added_by', auth('api')->user()->id)->where('post_id',$post->post_info['id'])->first();
                if (isset($fav)) {
                    $post->favourite = "yes";
                        // return response()->json(['s']);
                }else{
                    $post->favourite = "no";
                }
            }
        }
        return response()->json([
            'advertise' => $advertise,
            'all_category' => $category,
            'breaking_news' => $breakingnews,
            'category_news' => $hotnews,
        ]);
    }

    public function trendingNews()
    {
        $breakingnews = Post::where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);

        $trending_news = Post::where('is_trending', 1)->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->paginate(5);      
        foreach($trending_news AS $post){
            $post->imageurl = url("/upload/post/".$post->image);
            $post->sub_category = @$post->sub_cat_info['title'];
            if (Auth::guard('api')->check()){
                logger(Auth::guard('api')->user()); // to get user
                $fav = Favourite::where('added_by', auth('api')->user()->id)->where('post_id',$post->id)->first();
                if (isset($fav)) {
                    $post->favourite = "yes";
                        // return response()->json(['s']);
                }else{
                    $post->favourite = "no";
                }
            }
        }

        return response()->json([
            'breakingnews' => $breakingnews,
            'advertise' => $advertise,
            'category_news' => $trending_news,
        ]);
    }

    public function popularNews()
    {
        $breakingnews = Post::where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);

        $popular_news = Popular::where('video_id',null)->with('post_info')->orderBy('id','DESC')->paginate(5);
        foreach($popular_news AS $post){
            $post->imageurl = url("/upload/post/".$post->post_info['image']);
            $post->sub_cat_id = @$post->post_info->sub_cat_info['id'];
          	$post->sub_category = @$post->post_info->sub_cat_info['title'];
            if (Auth::guard('api')->check()){
                logger(Auth::guard('api')->user()); // to get user
                $fav = Favourite::where('added_by', auth('api')->user()->id)->where('post_id',$post->post_info['id'])->first();
                if (isset($fav)) {
                    $post->favourite = "yes";
                        // return response()->json(['s']);
                }else{
                    $post->favourite = "no";
                }
            }
        }

        return response()->json([
            'breakingnews' => $breakingnews,
            'advertise' => $advertise,
            'category_news' => $popular_news,
        ]);
    }

    public function featuredNews()
    {
        $breakingnews = Post::where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);

        $featured_news = Featured::where('video_id',null)->with('post_info')->orderBy('id','DESC')->paginate(5);
        foreach($featured_news AS $post){
            $post->imageurl = url("/upload/post/".$post->post_info['image']);
            $post->sub_cat_id = @$post->post_info->sub_cat_info['id'];
          	$post->sub_category = @$post->post_info->sub_cat_info['title'];
            if (Auth::guard('api')->check()){
                logger(Auth::guard('api')->user()); // to get user
                $fav = Favourite::where('added_by', auth('api')->user()->id)->where('post_id',$post->post_info['id'])->first();
                if (isset($fav)) {
                    $post->favourite = "yes";
                        // return response()->json(['s']);
                }else{
                    $post->favourite = "no";
                }
            }
        }

        return response()->json([
            'breakingnews' => $breakingnews,
            'advertise' => $advertise,
            'category_news' => $featured_news,
        ]);
    }

    public function categoryNews($categoryid)
    {
        $breakingnews = Post::where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        $advertise=Advertise::where('status','active')->get()->random(1)->first();
        $advertise->imageurl = url("/upload/advertise/".$advertise->image);

        $cat = Category::where('id',$categoryid)->first();
        $sub_categories = Category::where('parent_id', $cat->id)->get();

        $category_news = Post::where('cat_id',$cat->id)
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->paginate(5);
        foreach($category_news AS $post){
            $post->imageurl = url("/upload/post/".$post['image']);
            $post->sub_category = @$post->sub_cat_info['title'];
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
            'catgory_title' => $cat,
            'sub_categories' => $sub_categories,
            'breakingnews' => $breakingnews,
            'advertise' => $advertise,
            'category_news' => $category_news,
        ]);
    }

    public function popularmedia()
    {
        $popular = Popular::where('post_id',null)->with('video_info')->orderBy('id','DESC')->get()->toArray();
        $pop_id = array_column($popular,"video_id");
        $popular_media = Video::whereIn('id', $pop_id)->paginate(10);       

        if (isset($popular_media)) {
            foreach($popular_media AS $video){
                $video->video_path = url("/upload/fstv/video/".$video['video']);
                $video->thumbnail_path = url("/upload/fstv/video/".$video['image']);
                $video->video_link = url($video['link']);    
            }
            return response()->json([                
                'videos' => $popular_media,
            ]);
        }
    }
  public function featuredmedia()
    {
        $featured = Featured::where('post_id',null)->with('video_info')->orderBy('id','DESC')->get()->toArray();
        $pop_id = array_column($featured,"video_id");
        $featured_media = Video::whereIn('id', $pop_id)->paginate(10);       

        if (isset($featured_media)) {
            foreach($featured_media AS $video){
                $video->video_path = url("/upload/fstv/video/".$video['video']);
                $video->thumbnail_path = url("/upload/fstv/video/".$video['image']);
                $video->video_link = url($video['link']);    
            }
            return response()->json([                
                'videos' => $featured_media,
            ]);
        }
    }
}
