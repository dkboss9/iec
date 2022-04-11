<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Menu;
use App\Models\Submenu;

class SubmenuController extends Controller
{
    protected $submenu = null;

    public function __construct(Submenu $submenu)
    {
        $this->submenu = $submenu;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Submenu::with('menu_info')->orderby('id','DESC')->paginate(10);
        return view('admin.fstv.submenu')->with('data',$data);
    }

    public function getsubmenu(Request $request){
        if($request->menu_id == null){
            return response()->json(['status'=>false,'data'=>null,'msg'=>'No Sub menu.']);
        }
        $this->submenu = $this->submenu->getsubmenus($request->menu_id);
        if($this->submenu->count()){
            // child cat exists
            return response()->json(['status'=>true,'data'=>$this->submenu, 'msg'=>'success']);
        } else {
            //
            return response()->json(['status'=>false,'data'=>null,'msg'=>'No Sub menu.']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_info = Menu::pluck('title','id');
        return view('admin.fstv.submenu-form')
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
        // dd($request);
        $rules = $this->submenu->rules();
        $request->validate($rules);

        $data = $request->all();
        $this->submenu->fill($data);
        
        $status = $this->submenu->save();
        if ($status) {
            $request->session()->flash('success','Blog uploaded successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('submenu.index');
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
        $this->submenu = $this->submenu->find($id);
        $menu_info = Menu::pluck('title','id');
        return view('admin.fstv.submenu-form')
            ->with('submenu_detail',$this->submenu)
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
        $this->submenu = $this->submenu->with('menu_info')->find($id);
        if(!$this->submenu){
            request()->session()->flash('error','submenu not found.');
            return redirect(route('submenu.index'));
        }
        $rules = $this->submenu->rules('update');
        $request->validate($rules);

        $data = $request->all();
        $this->submenu->fill($data);
        
        $status = $this->submenu->save();
        if($status){           
            $request->session()->flash('success','submenu updated successfully.');
        } else {
            $request->session()->flash('error','Sorry! There was problem while updating.');
        }

        return redirect()->route('submenu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $submenu = $this->submenu->find($id);
        if(!$submenu){
            request()->session()->flash('error','submenu not found.');
            return redirect(route('submenu.index'));
        }
        $submenu->delete();
        return redirect(route('submenu.index'));
    }
}
