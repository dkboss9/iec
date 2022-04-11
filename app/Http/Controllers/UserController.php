<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use File;
use Validator;
use Session;
use App\User;
use App\Models\Userinfo;
use App\Models\Editor;
use App\Models\Operator;
use App\Models\Category;
use App\Models\UsersCategory;

class UserController extends Controller
{
    protected $user = null;
    protected $userinfo = null;
    public function __construct(User $user, Userinfo $userinfo)
    {
        $this->user = $user;
        $this->userinfo = $userinfo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile()
    {
        if (Auth::user()->role == 'admin' &&  Auth::user()->status == 'active') {
            $this->user = $this->user->with('user_info')->find(Auth::user()->id);
            return view('admin.profile')->with('user_detail',$this->user);

        }elseif (Auth::user()->role == 'editor' &&  Auth::user()->status == 'active') {
            $this->user = $this->user->with('editor_info')->find(Auth::user()->id);

            $cat_list = UsersCategory::where('editor_id',Auth::user()->editor_info['id'])->where('cat_id','!=',null)->with('cat_info')->get();
            foreach ($cat_list as $item) {
                $item->c = $item->cat_info['title'];
            }
            // dd($cat_list);
            $menu_list = UsersCategory::where('editor_id',Auth::user()->editor_info['id'])->where('menu_id','!=',null)->with('menu_info')->get();
            foreach ($menu_list as $item) {
                $item->m = $item->menu_info['title'];
            }
            return view('editor.profile')
                ->with('cat_list',$cat_list)
                ->with('menu_list',$menu_list)
                ->with('user_detail',$this->user);
            
        }elseif (Auth::user()->role == 'operator' &&  Auth::user()->status == 'active') {
            $this->user = $this->user->with('operator_info')->find(Auth::user()->id);

            $cat_list = UsersCategory::where('operator_id',Auth::user()->operator_info['id'])->where('cat_id','!=',null)->with('cat_info')->get();
            foreach ($cat_list as $item) {
                $item->c = $item->cat_info['title'];
            }
            // dd($cat_list);
            $menu_list = UsersCategory::where('operator_id',Auth::user()->operator_info['id'])->where('menu_id','!=',null)->with('menu_info')->get();
            foreach ($menu_list as $item) {
                $item->m = $item->menu_info['title'];
            }
            return view('operator.profile')
                ->with('cat_list',$cat_list)
                ->with('menu_list',$menu_list)
                ->with('user_detail',$this->user);

        }else{
            return redirect()->back();
        }
    }
    public function index()
    {
        $admin = User::where('id','!=',request()->user()->id)->where('id', '!=', 1)->with('user_info')->where('role','admin')->orderBy('id','desc')->paginate(10);
        return view('admin.userlist.admin-list')->with('data',$admin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->id == '1') {
            return view('admin.profile-edit');
        }else{
            Session::flash('error','Unauthorized action.');
            return redirect()->back();
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
        $rules = $this->user->Rules('add');
        $request->validate($rules);

        $data = $request->except('image');
        $data['password'] = Hash::make($request->password);
        $this->user->fill($data);
        $status = $this->user->save();

        if($status){
            if ($request->hasFile('image')) {
                $image = $request->image;
                $image_path = public_path("/upload/users/".$image);
                if(file_exists($image_path)){
                    File::delete($image_path);
                }

                $file_ext = $request->file('image');
                $file_name = time().'.'.$file_ext->getClientOriginalExtension();
                $file_ext->move(public_path('/upload/users/'), $file_name); 
                $data['image']= $file_name;
            }

            $data['added_by'] = $request->user()->id;
            $data['user_id'] = $this->user->id;

            $user_info = new UserInfo();
            $user_info->fill($data);
            $user_info->save();

            Session::flash('message', "Admin added Successfully.");
        } else {
            Session::flash('error','Eror occured..');
        }
        return redirect()->route('users.index');
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
        $this->user = User::with('user_info')->find($id);
        if(!$this->user){
            request()->session()->flash('error','User does not exists.');
            return redirect()->back();
        }
     	if (auth()->user()->role != 'admin' && auth()->user()->id != 1 ) {
          if(auth()->user()->id == $id){
            Session::flash('error','Unauthorized action.');
            return redirect()->back();
          }
        }
        return view('admin.profile-edit')->with('user_detail',$this->user);
    }

    public function profileEdit($id)
    {
        if (Auth::user()->role == 'admin' &&  Auth::user()->status == 'active') {
            $this->user = $this->user->with('user_info')->find(Auth::user()->id);
            return view('admin.profile-edit')->with('user_detail',$this->user);

        }elseif (Auth::user()->role == 'editor' &&  Auth::user()->status == 'active') {
            $this->user = $this->user->with('editor_info')->find(Auth::user()->id);
           
            $editor_id = $this->user->editor_info['id'];
            $editor = Editor::with('cat_info')->find($editor_id);
            $asociated_cats = UsersCategory::where('editor_id',$editor_id)->where('cat_id','!=',null)->pluck('cat_id')->toArray();
            $asociated_menu = UsersCategory::where('editor_id',$editor_id)->where('menu_id','!=',null)->pluck('menu_id')->toArray();
            // dd($editor_id);
            return view('editor.profile-edit')->with('user_detail',$this->user)
                ->with('men',$asociated_menu)
                ->with('ass',$asociated_cats);

        }elseif (Auth::user()->role == 'operator' &&  Auth::user()->status == 'active') {
            $this->user = $this->user->with('operator_info')->find(Auth::user()->id);

            $operator_id = $this->user->operator_info['id'];
            $operator = Operator::with('cat_info')->find($operator_id);
            $asociated_cats = UsersCategory::where('operator_id',$operator_id)->where('cat_id','!=',null)->pluck('cat_id')->toArray();
            $asociated_menu = UsersCategory::where('operator_id',$operator_id)->where('menu_id','!=',null)->pluck('menu_id')->toArray();
            // dd($operator_id);
            return view('operator.profile-edit')->with('user_detail',$this->user)
                ->with('men',$asociated_menu)
                ->with('ass',$asociated_cats);

        }else{
            return redirect()->back();
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
        // dd($request);
        $this->user = $this->user->with('user_info')->find($id);
        if(!$this->user){
            request()->session()->flash('error','Admin does not exists.');
            return redirect()->back();
        }
        
        $rules = $this->user->Rules('update');
        $request->validate($rules);
        
        $data = $request->except('image');
        // dd($data);
        if(isset($request->change_password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $this->user->password;
        }
            
        $this->user->fill($data);
        $status = $this->user->save();

        if($status){
            if ($request->hasFile('image')) {
                $image = $this->user->user_info['image'];
                $image_path = public_path("/upload/users/".$image);
                if(file_exists($image_path)){
                    File::delete($image_path);
                }

                $file_ext = $request->file('image');
                $file_name = time().'.'.$file_ext->getClientOriginalExtension();
                $file_ext->move(public_path('/upload/users/'), $file_name); 
                $data['image']= $file_name;
            }

            $data['added_by'] = $request->user()->id;
            $data['user_id'] = $this->user->id;

            $user_info = UserInfo::where("user_id",$this->user->id)->first();
          
            if(empty($user_info)){
                $user_info = new UserInfo();
            }
               
            $user_info->fill($data);
            $user_info->save();

            Session::flash('message', "Admin updated Successfully.");
        } else {
            Session::flash('error','Eror occured..');
        }
        
        if(auth()->user()->id == $this->user->id){
            return redirect()->route('profile');
        }else{
            return redirect()->route('users.index');
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
        $user = $this->user->find($id);
        if(!$user){
            Session::flash('message','Admin was not found.');
            return redirect()->back();
        }
      	if (auth()->user()->role != 'admin' && auth()->user()->id != 1 ) {
            if(auth()->user()->id == $id){
            Session::flash('error','Unauthorized action.');
            return redirect()->back();
          }
        }
        $status = $user->delete();
        if ($status) {
            Session::flash('message','Admin has been deleted successfully.');
            return redirect()->back();
        }

    }

    public function app_users()
    {
        $users = User::where('role','user')->paginate(10);
        return view('admin.userlist.app_users_list')->with('user_list',$users);
    }

    public function admin_list()
    {
        $data = User::where('id','!=',request()->user()->id)->where('id', '!=', 1)->with('user_info')->where('role','admin')->orderBy('id','desc')->paginate(10);
        return view('admin.userlist.admin-list')->with('data',$data);
    }
   
}
