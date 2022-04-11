<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

use App\Models\Post;
use App\Models\Operator;
use App\Models\Editor;
use App\Models\Video;
use App\Models\Blog;
use App\Models\Support;
use App\Models\DayWinner;
use App\Models\WeeklyWinner;
use App\Models\MonthlyWinner;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->status != 'active'){
            Auth::logout();
            return redirect()->route('login')->with('message','Your account has not been activated yet.');
        }
        return redirect()->route(request()->user()->role);
    }

    public function admin(){
         $total_support = Support::all();
         $total_unpublish_blog = Blog::where('status','active')->get();
        $day_winner = DayWinner::latest()->get()->count();
        $week_winner = WeeklyWinner::latest()->get()->count();
        $month_winner = MonthlyWinner::latest()->get()->count();
        return view('admin.index')
        ->with('day_winner', $day_winner)
        ->with('week_winner', $week_winner)
        ->with('month_winner', $month_winner)
         ->with('total_unpublish_blog',$total_unpublish_blog)
         ->with('total_support',$total_support);
    }
    public function editor(){
        $unpublish_post = Post::where('added_by',auth()->user()->id)->whereStatus('inactive')->get();
        $unpublish_video = Video::where('added_by',auth()->user()->id)->whereStatus('inactive')->get();
        return view('editor.index')
        ->with('unpublish_epost',$unpublish_post)
        ->with('unpublish_evideo',$unpublish_video);
    }
    public function operator(){
        $unpublish_post = Post::where('added_by',auth()->user()->id)->whereStatus('inactive')->get();
        $unpublish_video = Video::where('added_by',auth()->user()->id)->whereStatus('inactive')->get();
        return view('operator.index')
        ->with('unpublish_opost',$unpublish_post)
        ->with('unpublish_ovideo',$unpublish_video);
    }

    public function user(){
        Auth::logout();
        return redirect('/login');
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        // return redirect(\URL::previous());
        return redirect('/login');
    }
}
