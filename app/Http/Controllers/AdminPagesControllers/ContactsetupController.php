<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contacts;
use DB;//import if you want to use sql commands directly
use Illuminate\Support\Facades\Storage;// will enable us access storage directory in 

class ContactsetupController extends Controller
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
$this->middleware('auth:blessingheartadmin');//un comment if you want to limit

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
  $data =DB::select("SELECT * FROM contacts
ORDER BY FIELD(detailtype, 'Tel', 'WhatsApp number', 'Email', 'WhatsApp link', 'Address', 'Map', 'Footer detail')");	
  //for editting in the same form purposes
  $Data = array('detailtype' =>'','descriptiontext' =>'','addontext' =>'','priority' =>'', 'id' =>0);
  //var_dump($data);
  //passing multiple data
  return view('pagesadmin.contactsetup')->with('DataInfo',$data)->with('DataToEdit', $Data);
} 

public function store(Request $request)
{
    
       //inserting data
    $data = new contacts();
    $data->detailtype = $request->type; //captured from form
    $data->descriptiontext = $request->descriptiontext; //captured from form
    $data->addontext = $request->addontext;
    $data->priority = $request->priority;
    $data->save();
     return redirect('manage-contact-setup')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
        $data = contacts::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database
        $data->delete();
        return redirect('manage-contact-setup')->with('success','Data deleted sucessfully '); //create a session variable Success to store
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
        $Data = contacts::find($id);
        $data =DB::select("SELECT * FROM contacts
ORDER BY FIELD(detailtype, 'Tel', 'WhatsApp number', 'Email', 'WhatsApp link', 'Address', 'Map', 'Footer detail')");
        //var_dump($data);
        //pass data to page for editting
         //passing multiple data
          return view('pagesadmin.contactsetup')->with('DataToEdit',$Data)->with('DataInfo',$data);
    
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
           //updating a testimonials data
           $data = contacts::find($id); //so we will have to find a particular data
           $data->detailtype = $request->type; //captured from form
           $data->descriptiontext = $request->descriptiontext; //captured from form
           $data->addontext = $request->addontext;
           $data->priority = $request->priority;
           $data->save();

    //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
            return redirect('manage-contact-setup')->with('success','Data updated sucessfully '); //create a session variable Success to store
            //amessage
    }






///////////////////////////////////////////////////////////////////////////////////////



    //
}





