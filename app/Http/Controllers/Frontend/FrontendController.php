<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use DB;
use Embed;
use Session;
use Stripe;
use Image;
use LaravelVideoEmbed;
use Aws;

use App\Models\Author;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Category;
use App\Models\Media;
use App\Models\Gallery;
use App\Models\Featured;
use App\Models\Popular;
use App\Models\Blog;
use App\Models\Termncondition;
use App\Models\Privacy;
use App\Models\Contributor;
use App\Models\Review;
use App\Models\Subscriber;
use App\Models\Submenu;
use App\Models\Video;
use App\Models\StripePay;
use App\Models\PoliPay;
use App\Models\Program;
use App\Models\Participant;

class FrontendController extends Controller
{
    public function homePage()
    {
        $posts = Post::where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->get();
        // dd($posts);
        // print_r($posts); die();
        // dd($featured[0]->post_info->author_info['name']);
        $gallery = Gallery::where('status','active')->orderBy('id','desc')->get(); 

        $cat= Category::where('parent_id', null)->pluck('id');
        // dd($cat);
        if(!$cat->isempty()){
            if(isset($cat) && count($cat) > 4){
                $cats1_post = Post::where('cat_id',$cat[0])->where('status','active')->orderBy('id','desc')->get();        
                $cats2_post = Post::where('cat_id',$cat[2])->where('status','active')->orderBy('id','desc')->get();
                $cats3_post = Post::where('cat_id',$cat[4])->where('status','active')->orderBy('id','desc')->get();
                $cats4_post = Post::where('cat_id',$cat[5])->where('status','active')->orderBy('id','desc')->get();
                
                return view('frontend.index')
                    ->with('cats1_post',$cats1_post) 
                    ->with('cats2_post',$cats2_post)      
                    ->with('cats3_post',$cats3_post)
                    ->with('cats4_post',$cats4_post)        
                    ->with('gallery',$gallery)  
                    ->with('posts',$posts);  
            }
        }else{
            return view('frontend.index')
                ->with('gallery',$gallery)  
                ->with('posts',$posts);  
        }
    }

    public function aboutus()
    {
        return view('frontend.about');
    }
    public function contactus()
    {
        $contact = Contact::all();
        return view('frontend.contact')->with('contact', $contact);
    }

    public function postDetail($id)
    {
        // dd($id);
        $post = Post::find($id);
        if (!$post) {
            Session::flash('message', "Post has been deleted.");
            return redirect()->route('homepage');
        }
        $contributor_post = Post::where('contributor_id', $post->contributor_id)->limit(2)->get();
        // dd($contributor_post);
        $review = Review::where('post_id', $id)->get();
        return view('frontend.post-detail')
            ->with('contributor_post', $contributor_post)
            ->with('review',$review)
            ->with('post',$post);
    }

    public function blog()
    {
        $blog = Blog::where('status','active')->orderBy('id','DESC')->paginate(4);

        return view('frontend.blog')
            ->with('blog',$blog);
    }
    public function blogDetail($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            Session::flash('message', "Blog has been deleted.");
            return redirect()->route('homepage');
        }  
        $review = Review::where('post_id', $id)->get();
        
        return view('frontend.blog-detail')
            ->with('review', $review)
            ->with('blog', $blog);
    }

    public function media()
    {
        $video = Video::where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->paginate(8);
        $trending_video = Video::where('status','active')->where('is_trending', 1)
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        $submenu = Submenu::where('status','active')->with('video_info')->limit(3)->get();
        // if(!$submenu->isempty()){
        //     if(isset($submenu) && count($submenu) > 2){
        //         $submenu1_video = Video::where('status','active')->where('submenu_id',$submenu[0]->id)->limit(3)->get();        
        //         $submenu2_video = Video::where('status','active')->where('submenu_id',$submenu[1]->id)->limit(3)->get();
        //         $submenu3_video = Video::where('status','active')->where('submenu_id',$submenu[2]->id)->limit(3)->get();
        //         // dd($trending_video);
        //         return view('frontend.video')
        //             ->with('submenu1_video',$submenu1_video) 
        //             ->with('submenu2_video',$submenu2_video)      
        //             ->with('submenu3_video',$submenu3_video)
        //             ->with('trending_video',$trending_video)  
        //             ->with('video',$video)
        //             ->with('submenu',$submenu);  
        //     }
        // }else{
        //     return view('frontend.video')
        //         ->with('trending_video',$trending_video)  
        //         ->with('submenu',$submenu);  
        // }
        return view('frontend.video')->with('videos',$video)
            ->with('trending_video',$trending_video)
            ->with('submenu',$submenu);
    }

    public function catVideo($id)
    {
        $cat_video = Video::where('menu_id',$id)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','desc')->paginate(10);
        $trending_video = Video::where('status','active')->where('is_trending', 1)
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();

        return view('frontend.fstv.cat-video')
            ->with('trending_video',$trending_video)  
            ->with('cat_video', $cat_video);
    }
    
    public function subcatVideo($id)
    {
        $subcat_video = Video::where('submenu_id',$id)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','desc')->paginate(10);
        $trending_video = Video::where('status','active')->where('is_trending', 1)
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        // dd($subcat_video);
        return view('frontend.fstv.subcat-video')
            ->with('trending_video',$trending_video)  
            ->with('subcat_video', $subcat_video);
    }
    public function childcatVideo($id)
    {
        $childcat_video = Video::where('childmenu_id',$id)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','asc')->paginate(10);
        $trending_video = Video::where('status','active')->where('is_trending', 1)
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();

        return view('frontend.fstv.childcat-video')
            ->with('trending_video',$trending_video)  
            ->with('childcat_video', $childcat_video);
    }

    public function videoDetail($id)
    {
        $video = Video::find($id);
        if (!$video) {
            Session::flash('message', "Video has been deleted.");
            return redirect()->route('homepage');
        }
        $trending_video = Video::where('is_trending', 1)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();
        $epsod = Video::where('childmenu_id',$video->childmenu_info['id'])->where('id', '!=',$id)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','asc')->get();
        if(!$epsod){
            $cat = Video::where('submenu_id', $video->submenu_info['id'])->where('status','active')
            ->where(function ($query) {
                $query->where('date',null)
                      ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
            })->orderBy('id','asc')->where('id', '!=', $id)->get();
            return view('frontend.fstv.video-detail')
                ->with('cat_vid',$cat_vid)  
                ->with('trending_video',$trending_video)  
                ->with('video', $video);
        }else{
            return view('frontend.fstv.video-detail')
            ->with('epsod',$epsod)  
            ->with('trending_video',$trending_video)  
            ->with('video', $video);
        }

        return view('frontend.fstv.video-detail')
            ->with('trending_video',$trending_video)  
            ->with('video', $video);
    }
    public function getFeaturedVideo()
    {
        $fvideos = Featured::whereNotNull('video_id')->with('video_info')->orderBy('id','DESC')->paginate(8);
        $trending_video = Video::where('is_trending', 1)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();

        return view('frontend.fstv.featured-video')->with('trending_video',$trending_video)->with('fvideos',$fvideos);

    }
    public function getPopularVideo()
    {
        $pvideos = Popular::whereNotNull('video_id')->with('video_info')->orderBy('id','DESC')->paginate(8);
        $trending_video = Video::where('is_trending', 1)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->limit(5)->get();

        return view('frontend.fstv.popular-video')->with('trending_video',$trending_video)->with('pvideos',$pvideos);

    }

    public function gallery()
    {
        $gallery = Gallery::where('status','active')->with('created_by')->paginate();
        return view('frontend.gallery')->with('gallery', $gallery);
    }
   

    public function categoryPost($id)
    {
        $post = Post::where('cat_id', $id)->where('status','active')
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->orderBy('id','DESC')->paginate(4);
      
        return view('frontend.cat-post')
            ->with('post', $post);
    }
    public function childPost($id)
    {
        $post = Post::where('status','active')->where('sub_cat_id', $id)
        ->where(function ($query) {
            $query->where('date',null)
                  ->orWhere('date', '<=', Carbon::today()->format('Y-m-d'));
        })->paginate(4);
        return view('frontend.childcat-post')         
            ->with('post', $post);
    }
    
    public function contributor()
    {
        $contributor = Contributor::orderBy('id', 'DESC')->paginate(4);
        return view('frontend.contributor')->with('contributor', $contributor);
    }
    public function contributorDetail($id)
    {
        $contributor = Contributor::where('id', $id)->first();
        if (!$contributor) {
            Session::flash('message', "Video has been deleted.");
            return redirect()->route('homepage');
        }
        $post = Post::where('contributor_id', $id)->orderBy('id', 'DESC')->paginate(4);
      
        return view('frontend.contributor-detail')
            ->with('post', $post)
            ->with('contributor', $contributor);
    }

    public function terms()
    {
        $terms = Termncondition::first();
        if (!$terms) {
            Session::flash('message', "Terms has been deleted.");
            return redirect()->route('homepage');
        }      
        return view('frontend.terms')->with('terms', $terms);
    }

    public function privacy()
    {
        $privacy = Termncondition::first();
        if (!$privacy) {
            Session::flash('message', "Privacy has been deleted.");
            return redirect()->route('homepage');
        }      
        return view('frontend.privacy')->with('privacy', $privacy);
    }

    public function stripe()
    {
        return view('frontend.stripe-form');
    }

    public function stripePay(Request $request)
    {
        // dd($request);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $s = Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "AUD",
                "source" => $request->stripeToken,
                "description" => "Making Stripe Payment." 
                ]);
        if ($s) {
            $data = new StripePay();
            $data['transaction_id'] = $s->id;
            $data['payment_method'] = $s->payment_method;
            $data['receipt_url'] = $s->receipt_url;
            $data['amount'] = ($s->amount)/100;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $status = $data->save();
        }

  
        Session::flash('message', 'Payment has been successfully processed.');
          
        return back();
    }

    public function poli()
    {
        return view('frontend.poli-form');
    }

    public function poliPay(Request $request)
    {
        // dd($request);
        $json_builder = '{
            "Amount": "'.$request->amount.'",
            "CurrencyCode":"AUD",
            "MerchantReference":"'.$request->name.'",
            "MerchantHomepageURL":"http://127.0.0.1:8000",
            "SuccessURL":"http://127.0.0.1:8000/polipayment/token",
            "FailureURL":"http://127.0.0.1:8000/poli",
            "CancellationURL":"http://127.0.0.1:8000",
            "NotificationURL":"http://127.0.0.1:8000"             
        }';
         
        $auth = 'U1M2MTAwMDQ4NDp0WDlebDVFUzh5ZGYz';
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Authorization: Basic '.$auth;
         
        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/Initiate");
        //See the cURL documentation for more information: http://curl.haxx.se/docs/sslcerts.html
        //We recommend using this bundle: https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt
        // curl_setopt( $ch, CURLOPT_CAINFO, "ca-bundle.crt");
        if ( ! defined('CURL_SSLVERSION_TLSv1_2')) {
            define('CURL_SSLVERSION_TLSv1_2', 6);
        }
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_builder);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        curl_close ($ch);

        $json = json_decode($response, true);
        // dd($json);
        // $json['NavigateURL'] = "";
        // $token = $json['NavigateURL'];
        header('Location: '.$json["NavigateURL"]); 
        // dd($response);     
        die();        
    }

    public function poliPayment()
    {
        
        $token = $_GET["token"];
        if(is_null($token)) {
            $token = $_Post["token"];
        }
        // dd(urlencode($token));
        
        $auth = 'U1M2MTAwMDQ4NDp0WDlebDVFUzh5ZGYz';
        $header = array();
        $header[] = 'Authorization: Basic '.$auth;
        
        $ch = curl_init("https://poliapi.apac.paywithpoli.com/api/v2/Transaction/GetTransaction?token=".urlencode($token));
        //See the cURL documentation for more information: http://curl.haxx.se/docs/sslcerts.html
        //We recommend using this bundle: https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt
        // curl_setopt( $ch, CURLOPT_CAINFO, "ca-bundle.crt");
        if ( ! defined('CURL_SSLVERSION_TLSv1_2')) {
            define('CURL_SSLVERSION_TLSv1_2', 6);
        }
        curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_POST, 0);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        curl_close ($ch);
        
        $json = json_decode($response, true);
        
        // dd($json);
        $data = new PoliPay();
        $data['transaction_id'] = $json['TransactionID'];
        $data['finance_code'] = $json['FinancialInstitutionName'];
        $data['country'] = $json['CountryName'];
        $data['amount'] = $json['PaymentAmount'];
        $data['name'] = $json['MerchantReference'];
        $status = $data->save();
        Session::flash('message','Payment Succussfull.');
        return redirect()->route('poli');
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function programList()
    {
        $program = Program::whereStatus('active')->get();
        return view('frontend.program-list')->with('program',$program);
    }
    
    public function participantForm($id)
    {
        // dd($id);
        $program = Program::find($id);
        return view('frontend.participant-form')->with('program',$program);
    }

    public function participantSave(Request $request)
    {
        // dd($request);
        $sdk = new Aws\Sdk([
            'region'      => 'ap-southeast-2',
            'version'  => 'latest',
            'credentials' => [
                'key' => "AKIATYSHCFT5WRL7OA4D",
                'secret'  => "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",
            ],
        ]);
        $s3Client = $sdk->createS3();
        $bucketName= 'firescreentv';
        if (!$s3Client->doesBucketExist($bucketName)) { 
            try {
                $result = $s3Client->createBucket([
                    'Bucket' => $bucketName,
                ]);
            }catch (AwsException $e) {
                // output error message if fails
                dd($e->getMessage());
                echo "\n";
            }          
        }
        
        // dd($request);
        $participant = new Participant;
        $rules = $participant->rules();
        $request->validate($rules);
        
        $data = $request->except('image','identification','video');
        
        if ($request->hasFile('image')) {
            $file_ext = $request->file('image');
            $file_name = time().'-'.$file_ext->getClientOriginalName();
            $file_ext->move(public_path('upload/participant/'), $file_name,60);           
            $data['image']= $file_name;
            
            Image::make(public_path('upload/participant').'/'.$file_name)->resize(null, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/participant').'/Thumb-lg-'.$file_name,60);
            
        }
        
        $images=array();
        if($files=$request->file('identification')){
            foreach($files as $file){
                $name= time().'-'.$file->getClientOriginalName();
                $file->move(public_path('upload/participant/'), $name,60);           
                $images[]=$name;
            }
            $data['identification'] =  implode("|",$images);
        }
        // dd($data);
        if ($request->file('video')) {
            $video = $request->file('video');
            $v_name= time().'-'.$video->getClientOriginalName();
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucketName,
                    'Key' => '/program-participate/' . $v_name,
                    'SourceFile' => $request->video,
                ]);
                // dd($result);
                $data['video']= $v_name;
                $data['video_url']=$result['ObjectURL'];
            } catch (S3Exception $e) {
                dd($e->getMessage()) . "\n";
            }
            // $s3 = \Storage::disk('s3');
            // $s3->put('/program-participate/' . $v_name, file_get_contents($video), 's3');
        }
        // dd($name,$data);
        $participant->fill($data);
        // dd($data, $participant);
        $status = $participant->save();
        if ($status) {
            Session::flash('message',' Form submitted successfully wait for approval.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->back();
    
    }
}
