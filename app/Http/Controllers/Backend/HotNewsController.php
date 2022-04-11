<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\HotNews;
use App\Models\Category;
use App\Models\Featured;

class HotNewsController extends Controller
{
    public function index()
    {
        $hotnews = HotNews::with('created_by')->paginate(8);
        $post = Post::get();
        return view('admin.hot-news')->with('hotnews', $hotnews)->with('post', $post);
    }

    public function getHotNewsPosts(){
        $hotnews = HotNews::orderBy('id','DESC')->get(); 
        // dd($hotnews); 
        return view('frontend.hotnews')->with('hotnews', $hotnews);
    }
}
