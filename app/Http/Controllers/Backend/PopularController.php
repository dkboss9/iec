<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Video;
use App\Models\Popular;

class PopularController extends Controller
{
    public function index()
    {
        $popular = Popular::with(['post_info','video_info'])->orderBy('id','desc')->with('created_by')->get();
        if (auth()->user()->role == 'editor') {
            $posts = Post::where('added_by',auth()->user()->id)
            ->with(['cat_info','sub_cat_info','created_by'])->get();
            $videos = Video::where('added_by',auth()->user()->id)
            ->with(['menu_info','created_by'])->get();

            $v = array_column($videos->toArray(),'id');
            $p = array_column($posts->toArray(),'id');
            $pp = Popular::whereIn('post_id',$p)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $vv = Popular::whereIn('video_id',$v)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $popular = $vv->merge($pp);
            return view('editor.popular')->with('popular',$popular);

        }elseif(auth()->user()->role == 'operator'){
            $posts = Post::where('added_by',auth()->user()->id)
            ->with(['cat_info','sub_cat_info','created_by'])->get();
            $videos = Video::where('added_by',auth()->user()->id)->get();

            $v = array_column($videos->toArray(),'id');
            $p = array_column($posts->toArray(),'id');
            $pp = Popular::whereIn('post_id',$p)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $vv = Popular::whereIn('video_id',$v)->with(['post_info','video_info'])->with('created_by')->orderBy('id','desc')->paginate(10);
            $popular = $vv->merge($pp);
            // dd($popular);
            return view('operator.popular')->with('popular',$popular);
        }
        return view('admin.popular')->with('popular', $popular);
    }

    public function getPopularPosts(){
        $popular = Popular::whereNotNull('post_id')->orderBy('id','DESC')->get();      
        return view('frontend.popular')->with('popular', $popular);
    }
    
}
