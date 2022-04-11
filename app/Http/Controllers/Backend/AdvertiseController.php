<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\Adsvisit;
use Image;
use File;
use Auth;
use Session;


class AdvertiseController extends Controller
{
    public $advertise = null;

    public function __construct(Advertise $advertise)
    {
        $this->advertise = $advertise;
        // $this->middleware('')->only();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('s');
        if (auth()->user()->role != 'admin') {
            $advertise = Advertise::where('added_by',auth()->user()->id)->with('adsvisit')->orderBy('id','desc')->paginate(10);
            return view('operator.advertise')->with('advertise', $advertise);
        }
        $advertise = Advertise::with('adsvisit')->orderBy('id','desc')->paginate(10);
        return view('admin.advertise')->with('advertise', $advertise);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role != 'admin') {
            if (@auth()->user()->operator_info['adver'] == 1) {
                return view('operator.advertise-form');
            }else{
                Session::flash('error', 'You do not have access to add advertise.');
                return redirect()->route('advertise.index');
            }
        }
        return view('admin.advertise-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if ($request->link_type == 'internal') {
            $this->validate($request,[
                'link'=>'required|string',
            ],
            [
                'link.required' => 'You must put the internal link.',
            ]);
        }else{
            $this->validate($request,[
                'link'=>'required|url',
            ],
            [
                'link.required' => 'You must put the valid external link.',
            ]); 
        }
        
        $rules = $this->advertise->Rule();
        $request->validate($rules);

        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        if ($request->link_type == 'internal') {
            $data['link'] = null;
        }
        if ($request->link_type == 'external') {
            $data['ilink'] = null;
        }
        
        if ($request->hasFile('image')) {
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/advertise/'), $file_name);           
            $data['image']= $file_name;

            if($request->type == 'image'){
                
                Image::make(public_path('upload/advertise').'/'.$file_name)->resize(null, 90, function ($constraints){
                    return $constraints->aspectRatio();
                })->save(public_path('upload/advertise').'/Thumb-lg-'.$file_name,60);
            }
           
        }
        // dd($data);
        $this->advertise->fill($data);
        $status = $this->advertise->save();
        if ($status) {
            Session::flash('message', "Advertisement has been added successfully.");
            return redirect()->route('advertise.index');
        }

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
        $advertise = Advertise::find($id);
        if(!$advertise){
            Session::flash('error','Advertise not found.');
            return redirect()->route('advertise.index');
        }
        if (auth()->user()->role == 'admin') {
            return view('admin.advertise-form')->with('advertise_detail', $advertise);
        }elseif(auth()->user()->role == 'operator'){
            return view('operator.advertise-form')->with('advertise_detail', $advertise);
        }
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
        if ($request->link_type == 'internal') {
            $this->validate($request,[
                'link'=>'required|string',
            ],
            [
                'link.required' => 'You must put the internal link.',
            ]);
        }else{
            $this->validate($request,[
                'link'=>'required|url',
            ],
            [
                'link.required' => 'You must put the valid external link.',
            ]); 
        }
        $rules = $this->advertise->Rule('update');
        $request->validate($rules);
        
        $this->advertise = $this->advertise->find($id);
        // dd($this->advertise);
        if (!$this->advertise) {
            $Session::flash('error','advertise not found.');
            return redirect()->route('advertise.index');
        }

        $data = $request->except('image');
        $data['updated_by'] = $request->user()->id;
        if ($request->link_type == 'internal') {
            $data['link'] = null;
        }
        if ($request->link_type == 'external') {
            $data['ilink'] = null;
        }
        
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/advertise/'), $file_name);           
            $data['image']= $file_name;

            File::delete($this->advertise->image);

            if($request->type == 'image'){
                Image::make(public_path('upload/advertise').'/'.$file_name)->resize(null, 90, function ($constraints){
                    return $constraints->aspectRatio();
                })->save(public_path('upload/advertise').'/Thumb-lg-'.$file_name,60);

                $thumb2 = public_path('upload/advertise/'.'Thumb-lg-'.$this->advertise->image);
                if(file_exists($thumb2)){
                    File::delete($thumb2);
                }
            }

            $image_path = public_path('upload/advertise/'.$this->advertise->image);
            if(file_exists($image_path)){
                File::delete( $image_path);                   
            }
        }
        $this->advertise->fill($data);
        
        $status = $this->advertise->save();
        if ($status) {
            Session::flash('message','Advertise updated successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('advertise.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Advertise::findOrFail($id);
        $image_path = public_path('upload/advertise/'.$data->image);
        $thumb2 = public_path('upload/advertise/'.'Thumb-lg-'.$data->image);
        if(file_exists($image_path)){
            File::delete($thumb2);
          
            File::delete( $image_path);                   
        }
        $del = $data->delete();
        if ($del) {
            Session::flash('message','Advertise deleted successfully.');
            return redirect()->route('advertise.index');
        }
    }

    public function adsvisit(Request $request)
    {
        $data['ads_id'] = $_POST['ads_id'];
        Adsvisit::create($data);
       
        return redirect()->back();
    }
}
