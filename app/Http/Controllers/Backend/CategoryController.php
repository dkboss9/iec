<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use File;
use validation;
use DB;
use Session;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->category->where('is_parent',1)->with('parent_info')->get();
        // dd($category);
        return view('admin.category')->with('category_data', $category);
    }
    public function subCat()
    {
        $sub_cat = Category::where('is_parent', 0)->with('parent_info')->orderBy('id','DESC')->get();
        // dd($sub_cat);
        return view('admin.sub-category')->with('data', $sub_cat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = $this->category->where('is_parent',1)->pluck('title','id');
        return view('admin.category-form')->with('parent_cats',$parent_cats);
    }
    
    //child category
    public function getChildCats(Request $request){
        if($request->cat_id == null){
            return response()->json(['status'=>false,'data'=>null,'msg'=>'No child category.']);
        }
        $this->category = $this->category->getChildCat($request->cat_id);
        if($this->category->count()){
            // child cat exists
            return response()->json(['status'=>true,'data'=>$this->category, 'msg'=>'success']);
        } else {
            //
            return response()->json(['status'=>false,'data'=>null,'msg'=>'No child category.']);
        }
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
        if($request->is_parent == null && $request->parent_id == null || $request->is_parent != null && $request->parent_id != null ){
            Session::flash('error','You must make category parent or select category for sub-category.');
            return redirect()->back();
        }
        $rules = $this->category->rules();
        $request->validate($rules);

        $data = $request->all();
        $data['detail'] = htmlentities($request->detail);
        $data['added_by'] = $request->user()->id;
        $data['is_parent'] = $request->input('is_parent',0);

    //    dd($data, $request);
        $this->category->fill($data);
        
        $status = $this->category->save();
        if ($status) {
            Session::flash('success','Category added successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('category.index');
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
        $this->category = $this->category->find($id);
        // dd($this->category);
        if (!$this->category) {
            Session::flash('error','category not found.');
            return redirect()->route('category.index');
        }  
      
        $parent_cats = $this->category->where('is_parent',1)->pluck('title','id');
        // dd($this->category->is_parent, $parent_cats);
        return view('admin.category-form')       
            ->with('parent_cats',$parent_cats)
            ->with('category_detail',$this->category); 
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
        $rules = $this->category->rules('update');
        $request->validate($rules);
        // dd($request);
        
        $this->category = $this->category->find($id);
        // dd($this->category);
        if (!$this->category) {
            $Session::flash('error','category not found.');
            return redirect()->route('category.index');
        }

        $data['updated_by'] = $request->user()->id;
        $data['detail'] = htmlentities($request->detail);

        $data = $request->all();
        $this->category->fill($data);
        // dd($data);
        $status = $this->category->save();
        if ($status) {
            return redirect()->route('category.index');
        }else {
            Session::flash('error','Error occur.');
        }
        
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category = Category::findOrFail($id);
        $child_id = $this->category->where('parent_id', $this->category->id)->get();
        // dd($child_id);
        $del = $this->category->delete();
        if($del){
            if($child_id){
                $child_id->each->delete();
            }
           
            Session::flash('success','Category deleted successfully.');
        } else {
            Session::flash('error','Sorry! There was problem while deleting category.');
        }
        return redirect()->back();
        
    }
    
}
