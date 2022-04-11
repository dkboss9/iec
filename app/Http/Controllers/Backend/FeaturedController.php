<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Video;
use App\Models\Featured;

class FeaturedController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $featured = Featured::with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            return view('admin.featured')->with('featured', $featured);

        }elseif (auth()->user()->role == 'editor') {
            $posts = Post::where('added_by',auth()->user()->id)
            ->with(['cat_info','sub_cat_info','created_by'])
            ->get();
            $videos = Video::where('added_by',auth()->user()->id)
            ->with(['menu_info','created_by'])
            ->get();

            $v = array_column($videos->toArray(),'id');
            $p = array_column($posts->toArray(),'id');
            $pp = Featured::whereIn('post_id',$p)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $vv = Featured::whereIn('video_id',$v)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $featured = $vv->merge($pp);
            
            return view('editor.featured')->with('featured',$featured);

        }elseif (auth()->user()->role == 'operator') {
            $posts = Post::where('added_by',auth()->user()->id)
            ->with(['cat_info','sub_cat_info','created_by'])
            ->get();
            $videos = Video::where('added_by',auth()->user()->id)
            ->with(['menu_info','created_by'])
            ->get();

            $v = array_column($videos->toArray(),'id');
            $p = array_column($posts->toArray(),'id');
            $pp = Featured::whereIn('post_id',$p)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $vv = Featured::whereIn('video_id',$v)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $featured = $vv->merge($pp);
            // dd($featured);
            return view('operator.featured')->with('featured',$featured);
        }
    }

    public function getfeaturedPosts(){
        $featured = Featured::whereNotNull('post_id')->orderBy('id','DESC')->get();      
        return view('frontend.featured')->with('featured', $featured);
    }
}
