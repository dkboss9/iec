<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use File;
use Auth;
use DB;
use Session;



class ContactController extends Controller
{
    protected $contact = null;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = $this->contact->with('created_by')->paginate(5);
        return view('admin.contact')->with('contact_data', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->contact->rules();
        $request->validate($rules);
        
        $data = $request->all();
        // $data['detail'] = htmlentities($request->detail);
        $data['added_by'] = $request->user()->id;
                
        $this->contact->fill($data);        
        $status = $this->contact->save();
        if ($status) {
            Session::flash('message','Contact uploaded successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('contact.index');
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
        $this->contact = $this->contact->find($id);
        // dd($this->contact);
        if (!$this->contact) {
            request()->session()->flash('error','contact not found.');
            return redirect()->route('contact.index');
        }        
        return view('admin.contact-form')->with('contact_detail',$this->contact);  
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
        $rules = $this->contact->rules('update');
        $request->validate($rules);
        
        $this->contact = $this->contact->find($id);
        // dd($this->contact);
        if (!$this->contact) {
            Session::flash('error','contact not found.');
            return redirect()->route('contact.index');
        }

        $data['updated_by'] = $request->user()->id;
        // $data['detail'] = htmlentities($request->detail);

        $data = $request->all();
        
        $this->contact->fill($data);        
        $status = $this->contact->save();
        if ($status) {
            Session::flash('message','Contact updated successfully.');
        }else {
            Session::flash('error','Error occur.');
        }
        
        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Contact::findOrFail($id);
        $data->delete();

        return redirect()->route('contact.index');
    }
}
