<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Childmenu;

use Image;
use File;

class ChildmenuController extends Controller
{

    protected $childmenu = null;

    public function __construct(Childmenu $childmenu)
    {
        $this->childmenu = $childmenu;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Childmenu::with('menu_info')->orderBy('id','DESC')->paginate(10);
        return view('admin.fstv.childmenu')->with('data',$data);
    }

    public function getchildmenu(Request $request){
        if($request->submenu_id == null){
            return response()->json(['status'=>false,'data'=>null,'msg'=>'No child menu.']);
        }
        $this->childmenu = $this->childmenu->getchildmenus($request->submenu_id);
        if($this->childmenu->count()){
            // child cat exists
            return response()->json(['status'=>true,'data'=>$this->childmenu, 'msg'=>'success']);
        } else {
            //
            return response()->json(['status'=>false,'data'=>null,'msg'=>'No  menu.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_info = Menu::with('submenu_info')->pluck('title','id');
        
        return view('admin.fstv.childmenu-form')
        // ->with('submenu_info', $menu_info);
            ->with('menu_info', $menu_info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->childmenu->rules();
        $request->validate($rules);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/fstv/childmenu/'), $file_name,60);           
            $data['image']= $file_name;

            Image::make(public_path('upload/fstv/childmenu').'/'.$file_name)->resize(150, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/childmenu').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/fstv/childmenu').'/'.$file_name)->resize(500, 500, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/childmenu').'/Thumb-lg-'.$file_name,60);  
        }
        
        // dd($data);
        $this->childmenu->fill($data);
        
        $status = $this->childmenu->save();
        if ($status) {
            $request->session()->flash('success','Childmenu created successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('childmenu.index');
        
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
        $this->childmenu = $this->childmenu->find($id);
        $menu_info = Menu::pluck('title','id');
        $submenu_info = Submenu::pluck('title','id');
        return view('admin.fstv.childmenu-form')
            ->with('childmenu_detail',$this->childmenu)
            ->with('submenu_info',$submenu_info)
            ->with('menu_info',$menu_info);
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
        $this->childmenu = $this->childmenu->with('menu_info')->find($id);
        if(!$this->childmenu){
            request()->session()->flash('error','childmenu not found.');
            return redirect(route('childmenu.index'));
        }
        $rules = $this->childmenu->rules('update');
        $request->validate($rules);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            // dd($request);
            $file_ext = $request->file('image');
            $file_name = time().'.'.$file_ext->getClientOriginalExtension();
            $file_ext->move(public_path('upload/fstv/childmenu/'), $file_name,60);           
            $data['image']= $file_name;

            File::delete($this->childmenu->image);

            Image::make(public_path('upload/fstv/childmenu').'/'.$file_name)->resize(150, 150, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/childmenu').'/Thumb-sm-'.$file_name,60);
            Image::make(public_path('upload/fstv/childmenu').'/'.$file_name)->resize(300, 300, function ($constraints){
                return $constraints->aspectRatio();
            })->save(public_path('upload/fstv/childmenu').'/Thumb-lg-'.$file_name,60);

            $image_path = public_path('upload/fstv/childmenu/'.$this->childmenu->image);
            $thumb1 = public_path('upload/fstv/childmenu/'.'Thumb-sm-'.$this->childmenu->image);
            $thumb2 = public_path('upload/fstv/childmenu/'.'Thumb-lg-'.$this->childmenu->image);
            if(file_exists($image_path)){
                File::delete($thumb1);
                File::delete($thumb2);
              
                File::delete( $image_path);                   
            }
        }
        $this->childmenu->fill($data);
        
        $status = $this->childmenu->save();
        if($status){           
            $request->session()->flash('success','childmenu updated successfully.');
        } else {
            $request->session()->flash('error','Sorry! There was problem while updating.');
        }

        return redirect()->route('childmenu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $childmenu = $this->childmenu->find($id);
        if(!$childmenu){
            request()->session()->flash('error','childmenu not found.');
            return redirect(route('childmenu.index'));
        }
        $image_path = public_path('upload/fstv/childmenu/'.$childmenu->image);       
        $thumb1 = public_path('upload/fstv/childmenu/'.'Thumb-sm-'.$childmenu->image);
        $thumb2 = public_path('upload/fstv/childmenu/'.'Thumb-lg-'.$childmenu->image);
        if(file_exists($image_path)){
            File::delete($thumb1);
            File::delete($thumb2);          
            File::delete( $image_path);                   
        }
       
        $childmenu->delete();
        return redirect(route('childmenu.index'));

    }
}
