<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\servicesinfo;
use App\Models\service_details;
use App\AppHelper;
use DB;//import if you want to use sql commands directly
use Illuminate\Support\Facades\Storage;// will enable us access storage directory in 


class ServicesController extends Controller
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
 // $data =DB::select('select * from servicesinfo order by FIELD(type, "Web apps", "Mobile apps", "Webhosting","Other")');

    $data =DB::select('select * from servicesinfo order by id desc');
  //passing multiple data
  return view('pagesadmin.services')->with('DataInfo',$data);

} 

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


$Data = array(   

'id'=>0,
'name'=>'',
'heading'=>'',
'filename'=>'',
'widthsize'=>'600',
'heightsize'=>'500'
	
);

$servicedetailItems= array();

    return view('pagesadmin.service_create')->with('servicedetailItems',$servicedetailItems)->with('DataToEdit', $Data);

    }




public function store(Request $request)
{


    //handling the file upload
$upload_dir="service_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=$request->widthsize;
$fileNameToStore="nofile.png";
if(!empty($request->file('service_image'))){
$fileinput = $request->file('service_image');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
} 
   
    
       //inserting data
    $data = new servicesinfo();
    $data->name = $request->name; //captured from form
    $data->heading = $request->heading; //captured from form
    $data->widthsize = $request->widthsize; //captured from form
    $data->heightsize = $request->heightsize; //captured from form
    $data->filename = $fileNameToStore; //captured from form
    $sqlInsert=$data->save();
    
    if($sqlInsert){

      $last_service_InsertId =$data->id;//this get's the just inserted id;
//saving service details
for ($i = 0; $i < count($request->servicedescription); $i++) {
$servicedetailsdata = new service_details();
$servicedetailsdata->service_id=$last_service_InsertId; 
$servicedetailsdata->heading=""; 
$servicedetailsdata->description =$request->servicedescription[$i];
$sqlInsertdetails=$servicedetailsdata->save();

        } //end for loop 
     

}
     return redirect('manage-services/create')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
        $data = servicesinfo::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database
           if($data->filename != 'nofile.png'){
            Storage::delete('public/service_images/'.$data->filename);
            Storage::delete('public/service_images/thumbnails/'.$data->filename);
            }
       $deleted = $data->delete();

       if($deleted){
    //delete all the service_details having that service id and add them again
$sqlQuery =DB::delete('delete from service_details where service_id = ?',[$id]);
       }



        return redirect('manage-services')->with('success','Data deleted sucessfully '); //create a session variable Success to store
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
        $Data = servicesinfo::find($id);

        $servicedetailItems =DB::select('select * from service_details where service_id=:service_id order by id asc',["service_id"=>$id]);

//returns a view which contains our form to display data to edit
 //pass data to page for editting
         //passing multiple data
return view('pagesadmin.service_create')->with('servicedetailItems',$servicedetailItems)->with('DataToEdit', $Data);

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

    //handling the file upload
$upload_dir="service_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=$request->widthsize;
$fileNameToStore="nofile.png";
if(!empty($request->file('service_image'))){
$fileinput = $request->file('service_image');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
} 
    

           //updating a service info data
           $data = servicesinfo::find($id); //so we will have to find a particular data
             $data->name = $request->name; //captured from form
             $data->heading = $request->heading; //captured from form
             $data->widthsize = $request->widthsize; //captured from form
             $data->heightsize = $request->heightsize; //captured from form
           if($request->hasFile('service_image')){

                //delete previous file
(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$data->filename);          
                $data->filename = $fileNameToStore;
               }

  $sqlupdate=$data->save();
    
    if($sqlupdate){

    //delete all the service_details having that service id and add them again
$sqlQuery =DB::delete('delete from service_details where service_id = ?',[$id]);
//updating service details
for ($i = 0; $i < count($request->servicedescription); $i++) {
$servicedetailsdata = new service_details();
$servicedetailsdata->service_id=$id; 
$servicedetailsdata->heading=""; 
$servicedetailsdata->description =$request->servicedescription[$i];
$sqlInsertdetails=$servicedetailsdata->save();

        } //end for loop 
     

}
//////////////////////////////////////
            
    //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
            return redirect('manage-services/'.$id.'/edit')->with('success','Data updated sucessfully '); //create a session variable Success to store
            //amessage
    }






///////////////////////////////////////////////////////////////////////////////////////



    //
}




