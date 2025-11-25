<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\admin;
use DB;//import if you want to use sql commands directly
use Illuminate\Support\Facades\Storage;// will enable us access storage directory in 
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
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
  $data =DB::select('select * from admin where username!="bruno" order by id desc');
        
  //for editting in the same form purposes
  $Data = array('name' =>'','email' =>'','mobile' =>'','location' =>'','admintype' =>'','username' =>'','id' =>0);
  
  //var_dump($data);
  //passing multiple data
  if(Auth::user()->admintype=="Super admin"){
  return view('pagesadmin.admins')->with('DataInfo',$data)->with('DataToEdit', $Data);
}else{
   return redirect('dashboard')->with('success','Authorisation to access this page is required');  
}
} 

public function store(Request $request)
{


$salt="Oimoiumoi701310265";

       //inserting data
    $data = new admin();
$data->name=$request->fullname; //captured from form
$data->email=$request->email; //captured from form
$data->mobile=$request->contact; //captured from form
$data->location=$request->location; //captured from form
$data->admintype=$request->admintype; //captured from form
$data->username=$request->username; //captured from form

//get data if user name exist for matching with the
//query the db to prevent username duplicates
$results = DB::table('admin')->where('username',$request->input('username'))->get();
$result = json_decode($results,true);
if(sizeof($result) >0){
return redirect('manage-admins')->with('success','Username already exist,
 please try with another');
}

if($request->password!=""){
$data->password =Hash::make($request->password);//($request->password.$salt);
  }
$data->regdate=date('Y-m-d H:i:s');
$data->status="1";
    $data->save();
     return redirect('manage-admins')->with('success','Data saved sucessfully '); //create a session variable Success to store
     //amessage
}

 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = admin::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database

        $data->delete();
        return redirect('manage-admins')->with('success','Data deleted sucessfully '); //create a session variable Success to store
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
        $Data = admin::find($id);
        $data =DB::select('select * from admin order by id desc');
        //var_dump($data);
        //pass data to page for editting
         //passing multiple data
          return view('pagesadmin.admins')->with('DataToEdit',$Data)->with('DataInfo',$data);
    
    }



   /**
     * Updating.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

$salt="Oimoiumoi701310265";
           //updating a testimonials data
           $data = admin::find($id); //so we will have to find a particular data
           $data->name=$request->fullname; //captured from form
$data->email=$request->email; //captured from form
$data->mobile=$request->contact; //captured from form
$data->location=$request->location; //captured from form
$data->admintype=$request->admintype; //captured from form
$data->username=$request->username; //captured from form
if($request->password!=""){
$data->password =Hash::make($request->password);//sha1($request->password.$salt);
  }
$data->save();

    //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
            return redirect('manage-admins')->with('success','Data updated sucessfully '); //create a session variable Success to store
            //amessage
    }






///////////////////////////////////////////////////////////////////////////////////////



    //
}



