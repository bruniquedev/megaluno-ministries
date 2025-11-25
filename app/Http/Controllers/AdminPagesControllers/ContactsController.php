<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\messages;
use DB;//import if you want to use sql commands directly
use Illuminate\Support\Facades\Storage;// will enable us access storage directory in 

class ContactsController extends Controller
{

 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //call the parent controller which is the base controller using statement below
 // to make sure that the global variables in base controller are recieved in views whose 
 //controllers have a constructors. For those views whose controllers doesnt have a constructor 
 //in them you dont need to call this        
 parent::__construct();
        ////this helps in limiting those who are not logged in
//you can copy and paste this into other controllers where you want to limit login
      
   //register admin guard in the config\auth.php   
$this->middleware('auth:megalunaadmin');//un comment if you want to limit

        //go to app\Http\Controllers\Middleware\Authenticate.php in redirectTo function and the page/route
        //for redirection if user is not logged in return route('adminlogin')
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ////////////////////////////////////////////////////////////////
public function index()
{
  //USING sql command directly, you must first import "use DB;" 
  $data =DB::select('select * from messages order by id desc');	
  //var_dump($data);
  //passing multiple data
  return view('pagesadmin.contacts')->with('DataInfo',$data);
} 



 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = messages::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database
        $data->delete();
        return redirect('manage-contacts')->with('success','Data deleted sucessfully '); //create a session variable Success to store
        //amessage
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
        //returns a view which contains our form to display data to edit
        $Data = messages::find($id);
           $status=0;
          if($Data->seenstatus==0){
            $status = 1;
          }
          if($Data->seenstatus==1){
            $status = 0;
          }
         $Data->seenstatus=$status;
        $Data->save();
        //var_dump($data);
        //pass data to page for editting
         //passing multiple data
         return redirect('manage-contacts')->with('success','Data updated sucessfully '); //create a session variable Success to store
       
    
    }








///////////////////////////////////////////////////////////////////////////////////////



    //
}






