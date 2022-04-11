<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Models\NewsSignup;
use App\Jobs\SendNewsletterJob;
use Carbon;
use File;
use Mail;
use Session;
use App\Mail\SendNewsletterNotification;

class NewsletterController extends Controller
{
    protected $newsletter =null ;
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->newsletter->orderBy('id','DeSC')->get();
        return view('admin.newsletter')->with('newsletter_data', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsletter-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->newsletter->rules();
        $request->validate($rules);
        $data = $request->except('attachment');
        $data['status'] = 'pending';
        // dd($request, $data);

        if ($request->hasFile('attachment')) {
            // dd($request);
            $file_ext = $request->file('attachment');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/newsletter/'), $file_name);           
            $data['attachment']= $file_name;
        }

        $this->newsletter->fill($data);
        $status = $this->newsletter->save();
        if ($status) {
            Session::flash('success','newsletter created successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('newsletter.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Newsletter::find($id);
        return view('admin.newsletter-form')->with('newsletter',$data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->newsletter = $this->newsletter->find($id);
        
        $rules = $this->newsletter->rules('update');
        $request->validate($rules);

        $data = $request->except('attachment');
        $data['status'] = 'pending';

        if ($request->hasFile('attachment')) {
            // dd($request);
            $file_ext = $request->file('attachment');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/newsletter/'), $file_name);           
            $data['attachment']= $file_name;

            $image_path = public_path("/upload/newsletter/".$this->newsletter->attachment);
            if(file_exists($image_path)){
                File::delete($image_path);
            }

        }

        $this->newsletter->fill($data);
        $status = $this->newsletter->save();
        if ($status) {
           Session::flash('message','newsletter updated successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('newsletter.index')->with('message', 'Sign up successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Newsletter::find($id);
        $image_path = public_path('upload/newsletter/'.$data->attachment);
        if(file_exists($image_path)){
            File::delete( $image_path);
        }
        $data->delete();

        return redirect()->route('newsletter.index');
    }

    public function newsletter_detail($id)
    {
        // dd(now());
        $data = Newsletter::where('id',$id)->first();
        $nsubs = NewsSignup::orderBy('id','asc')->paginate(5);
        $subs = Subscriber::orderBy('id','asc')->paginate(5);
        // $sbs = NewsSignup::select('email','id');
        // $subs =$ssbs->union($sbs)->paginate(3);

        // dd($subs);
        return view('admin.newsletter-detail')
        ->with('subs',$subs)
        ->with('nsubs',$nsubs)
        ->with('detail',$data);
    }

    public function sendNewsletter(Request $request)
    {
        $users = $request->input("subscriber");
        
        foreach($users as $key => $user){
            $newsletter_id = $request->input("newsletter_id");
            $subscriber = NewsSignup::find($user);

            $n = Newsletter::where('id', $newsletter_id)->first();
            $email_contents = array(
                "email" => $subscriber->email,
                "title" => $n->title,
                "content" => $n->message,
                // "msg" => json_decode($n->message),
                "attachment" => $n->attachment,
            
            );
            $mail = Mail::send('newsletter_email', $email_contents, function ($message) use ($email_contents) {
                $message->to($email_contents['email']); 
                $message->subject($email_contents['title']); 
                $message->attach(public_path('upload/newsletter/'.$email_contents['attachment']));                             
            }); 

        
            
            
            // $newsletter_id = $request->input("newsletter_id");

            // $subscriber = NewsSignup::find($user);
            // SendNewsletterJob::dispatch($subscriber,$newsletter_id)
            // ->delay(now()->addSeconds(10));         
        }
        echo 'success';
    }
}
