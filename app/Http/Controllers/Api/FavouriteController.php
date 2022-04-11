<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Favourite;
use App\Models\Post;
use App\Models\Blog;
use App\Models\Adsvisit;
use App\User;
use Auth;
use JWTAuth;
use Carbon\Carbon;

use App\Device;

class FavouriteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); //ensures user is logged in
    // }

    
    public function makeFavourite(Request $request, $post_id)
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user

            $post = Post::with('sub_cat_info')->find($post_id);
            $post->imageurl = url("/upload/post/".$post->image);

            if ($post) {
                $fav = Favourite::where('added_by',auth('api')->user()->id)->where('post_id',$post_id)->first();
                if ($fav) {
                    $fav_id = $fav->id;
                    $news = Favourite::find($fav_id);
                    $status = $news->delete();
                    if ($status) {
                        $post->favourite = 'no';
                        return response()->json([
                            'post_detail' => $post,
                            'message'=>'News has been removed from favourite sucessfully.',
                        ]);
                    }else{
                        return response()->json(['error' => 'Sorry, there occurs a problems while adding to favourite.'],500);
                    }
                }else {
                    $data = new Favourite;
                    $data['post_id'] = $post_id;        
                    $data['added_by'] = auth('api')->user()->id;
        
                    $status = $data->save();
                    if ($status) {
                        $post->favourite = 'yes';
                        return response()->json([
                            'post_detail' => $post,
                            'message'=>'News has been added to favourite sucessfully.',
                        ]);
                    }else{
                        return response()->json(['error' => 'Sorry, there occurs a problems while adding to favourite.']);
                    }
                }
            }else{
                return response()->json([
                    'data' => 'News not found.',
                ]);
            }
        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }

    public function blogFavourite(Request $request, $blog_id)
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user

            $blog = Blog::find($blog_id);
            $blog->imageurl = url("/upload/blog/".$blog->image);

            if ($blog) {
                $fav = Favourite::where('added_by',auth('api')->user()->id)->where('blog_id',$blog_id)->first();
                if ($fav) {
                    $fav_id = $fav->id;
                    $news = Favourite::find($fav_id);
                    $status = $news->delete();
                    if ($status) {
                        $blog->favourite = 'no';
                        return response()->json([
                            'blog_detail' => $blog,
                            'message'=>'Blog has been removed from favourite sucessfully.',
                        ]);
                    }else{
                        return response()->json(['error' => 'Sorry, there occurs a problems while adding to favourite.'],500);
                    }
                }else {
                    $data = new Favourite;
                    $data['blog_id'] = $blog_id;        
                    $data['added_by'] = auth('api')->user()->id;
        
                    $status = $data->save();
                    if ($status) {
                        $blog->favourite = 'yes';
                        return response()->json([
                            'blog_detail' => $blog,
                            'message'=>'Blog has been added to favourite sucessfully.',
                        ]);
                    }else{
                        return response()->json(['error' => 'Sorry, there occurs a problems while adding to favourite.']);
                    }
                }
            }else{
                return response()->json([
                    'data' => 'Blog not found.',
                ]);
            }
        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }
    

    public function getFavouritePost(Request $request)
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user

            // $fav= Favourite::where('added_by', auth('api')->user()->id)->orderBy('id','desc')->get()->toArray();
            // $fav_id = array_column($fav,"post_id");
            // $favou = Post::whereIn('id', $fav_id)->get();       

            // foreach($favou AS $favourites){
            //     $favourites->favourite = 'yes';
            //     $favourites->imageurl = url("/upload/post/".$favourites['image']);
            //     $favourites->sub_category = $favourites->sub_cat_info['title'];
            // }

            $favou = Favourite::where('added_by',auth('api')->user()->id)->where('blog_id',null)->with('post_info')->orderBy('id','desc')->paginate(10);
            if (isset($favou)) {
                foreach ($favou as $fav) {
                    $fav->favourite = 'yes';
                    $fav->post_thumbnail_url = url("/upload/post/".$fav->post_info['image']);
                    $fav->sub_category = $fav->sub_cat_info;
                }
            }
            
            return response()->json([
                'favourite_list' => $favou,
            ]);  
        }         
    } 
    
    public function getFavouriteBlog(Request $request)
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user

            // $fav= Favourite::where('added_by', auth('api')->user()->id)->orderBy('id','desc')->get()->toArray();
            // $fav_id = array_column($fav,"blog_id");
            // $favou = Blog::whereIn('id', $fav_id)->get();       

            // foreach($favou AS $favourites){
            //     $favourites->favourite = 'yes';
            //     $favourites->imageurl = url("/upload/blog/".$favourites['image']);
            // }
            // return response()->json([
            //     'favourite_list' => $favou,
            // ]); 
            $favou = Favourite::where('added_by',auth('api')->user()->id)->where('post_id',null)->with('blog_info')->orderBy('id','desc')->paginate(10);
            if (isset($favou)) {
                foreach ($favou as $fav) {
                    $fav->favourite = 'yes';
                    $fav->imageurl = url("/upload/blog/".$fav->blog_info['image']);
                    // $fav->sub_category = $fav->sub_cat_info;
                }
            }
            
            return response()->json([
                'favourite_list' => $favou,
            ]); 
        }         
    } 

    public function adsvisit(Request $request,$ads_id)
    {
        $data['ads_id'] =$ads_id;
        Adsvisit::create($data);
        
        return response()->json('advertise watched.');
    }

}
