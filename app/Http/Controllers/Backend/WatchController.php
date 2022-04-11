<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Media;

class WatchController extends Controller
{
    public function index()
    {
        $watch = Watch::with('created_by')->paginate(8);
        $post = Media::get();
        return view('admin.watch')->with('watch', $watch)->with('post', $post);
    }

    public function getWatchPosts(){
        $watch = Watch::orderBy('id','DESC')->get();      
        return view('frontend.watch')->with('watch', $watch);
    }
}
