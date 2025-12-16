<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContentService;
use App\Traits\HandlesDeletion;
use App\Traits\HasContentDefaults;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;// will enable us access storage 
use App\Models\content_info;
use App\Models\content_details;
use Illuminate\Support\Str;
use DB;//import if you want to use sql commands directly

class ContactsController extends Controller
{

 use HandlesDeletion;    
use HasContentDefaults; 
 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {       
 parent::__construct();
      
$this->middleware('auth:megalunaadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ////////////////////////////////////////////////////////////////
public function index()
{

$data = content_info::where('page_area_type', 'message')->orderBy('sorted_order', 'asc')->orderBy('status', 'asc')->get(); 
  return view('pagesadmin.contacts')->with('DataInfo',$data);
} 


 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //returns a view which contains our form to display data to edit
        $Data = content_info::find($id);
           $status=0;
          if($Data->status==0){
            $status = 1;
          }
          if($Data->status==1){
            $status = 0;
          }
         $Data->status=$status;
        $Data->save();
       return back()->with('success', 'Content updated!');
       
    
    }



/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteById('content_info', $id);
           return back()->with('success', 'Data deleted sucessfully!');
    }




///////////////////////////////////////////////////////////////////////////////////////



    //
}






