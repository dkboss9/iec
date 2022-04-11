<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Post;
use App\Models\About;
use App\Models\Featured;
use App\Models\HotNews;
use App\Models\Menu;
use App\Models\Video;
use App\Models\Popular;
use App\Models\Advertise;
use App\Device;
// use ExchangeRate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
      Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
      
        $breakingnews = Post::where('status','active')->orderBY('id','DESC')->limit(5)->get();
        $about = About::first();
        $unpublish_post = Post::where('status','inactive')->get();
        $unpublish_video = Video::where('status','inactive')->get();
        $total_app_users = Device::where('cat_id',null)->where('post_id',null)->where('video_id',null)->get();
        $today_app_users = Device::whereDate('created_at', Carbon::today())->where('cat_id',null)->where('post_id',null)->where('video_id',null)->get();

        $cats = Category::where('is_parent', 1)->where('status','active')->limit(8)->get();
        $menu = Menu::where('status', 'active')->with('submenu_info')->limit(8)->get();
        $featured = Featured::whereNotNull('post_id')->with('post_info')->orderBy('id','DESC')->limit(5)->get();
        $featured_video = Featured::whereNotNull('video_id')->with('video_info')->orderBy('id','DESC')->limit(6)->get();
        $popular_video = Popular::whereNotNull('video_id')->with('video_info')->orderBy('id','DESC')->limit(6)->get();
        $hotnews = HotNews::orderBy('id','DESC')->limit(5)->get();
        $sidebar_lg_ads = Advertise::where('type','=','video')->where('status','active')->where('link_type','external')->inRandomOrder()->get();
        $content_lg_ads = Advertise::where('type','=','image')->where('status','active')->where('link_type','external')->inRandomOrder()->get();
        // dd($menu[0]->submenu_info);

        $category = new Category();
        $category = $category->getAllCategories();
        //  dd($sidebar_lg_ads);
        view::share([
            'cats' => $cats,
            'menu' => $menu,
            'sidebar_lg_ads' => $sidebar_lg_ads,
            'content_lg_ads' => $content_lg_ads,
            'category' => $category,
            'breakingnews' => $breakingnews,
            'about'=>$about,
            'featured'=>$featured,
            'featured_video'=>$featured_video,
            'popular_video'=>$popular_video,
            'hotnews'=>$hotnews,
            'unpublish_video'=>$unpublish_video,
            'unpublish_post'=>$unpublish_post,
            'total_app_users'=>$total_app_users,
            'today_app_users'=>$today_app_users,
            // 'rates'=> $result,
        ]);
      
    }
}
