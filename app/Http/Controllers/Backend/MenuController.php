<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Menu;
use File;
use Image;

class MenuController extends Controller
{
    protected $menu =null ;
    public function __construct(menu $menu)
    {
        $this->menu = $menu;       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::orderBY('id','DESC')->paginate(10);
        return view('admin.fstv.menu')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fstv.menu-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->menu->rules();
        $request->validate($rules);

        $data = $request->all();
        // dd($data);
        $this->menu->fill($data);
        
        $status = $this->menu->save();
        if ($status) {
            $request->session()->flash('success','Menu created successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('menu.index');
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
        $this->menu = $this->menu->find($id);
        if (!$this->menu) {
            request()->session()->flash('error','menu not found.');
            return redirect()->route('menu.index');
        }        
        return view('admin.fstv.menu-form')->with('menu_detail',$this->menu);  
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
        $rules = $this->menu->rules('update');
        $request->validate($rules);
        
        $this->menu = $this->menu->find($id);
        // dd($this->menu);
        if (!$this->menu) {
            $request()->session()->flash('error','menu not found.');
            return redirect()->route('menu.index');
        }

        $data = $request->all();
        
        $this->menu->fill($data);
        
        $status = $this->menu->save();
        if ($status) {
            $request->session()->flash('success','file updated successfully.');
        }else {
            $request->session()->flash('error','Error occur.');
        }
        
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = $this->menu->find($id);
        if(!$menu){
            request()->session()->flash('error','menu not found.');
            return redirect(route('menu.index'));
        }
        $menu->delete();
        return redirect(route('menu.index'));
    }
}
