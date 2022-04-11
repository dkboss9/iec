<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    protected $subscriber =null ;
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }
    public function subscribe(Request $request)
    {
        
        $request->validate([
            'email' => 'string|required|email|regex:/(.*)\.com/i|unique:subscribers,email',
            'subscribe_time' => 'string|nullable',
        ]);
            
            // dd($request);
        $data= $request->except('_token');
        
        $this->subscriber->fill($data);
        // dd($data);
        $this->subscriber->save();

        return redirect()->back();
    }

    public function index()
    {
        $data= Subscriber::all();
        return view('admin.subscriber')->with('data',$data);
    }

    public function delete($id)
    {
        $data = Subscriber::find($id);
        $data->delete();
        return redirect()->back();
    }
}
