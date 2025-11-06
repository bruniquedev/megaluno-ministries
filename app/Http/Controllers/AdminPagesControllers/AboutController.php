<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;//import if you want to use sql commands directly
use App\Models\aboutinfo;
use App\Models\about_details;
use App\AppHelper;
use Illuminate\Support\Facades\Storage;// will enable us access storage directory in 
class AboutController extends Controller
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
    public function index()
    {
        $data =DB::select('select * from aboutinfo order by id desc');
        //passing multiple data
        return view('pagesadmin.about')->with('DataInfo',$data);
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
            'headingtext'=>'',
            'filename'=>'',
            'widthsize'=>'600',
            'heightsize'=>'350'
    
            );
            
            $aboutdetailItems= array();
 return view('pagesadmin.about_create')->with('detailItems',$aboutdetailItems)->with('DataToEdit', $Data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //handling the file upload
$upload_dir="about_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=$request->widthsize;
$fileNameToStore="nofile.png";
if(!empty($request->file('input_image'))){
$fileinput = $request->file('input_image');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}       
    
           //inserting data
        $data = new aboutinfo();
        $data->headingtext = $request->heading; //captured from form
        $data->widthsize = $request->widthsize; //captured from form
        $data->heightsize = $request->heightsize; //captured from form
        $data->filename = $fileNameToStore; //captured from form
        $sqlInsert=$data->save();
        
        if($sqlInsert){
    
          $last_InsertId =$data->id;//this get's the just inserted id;
    //saving service details
    for ($i = 0; $i < count($request->detaildescription); $i++) {
    $detailsdata = new about_details();
    $detailsdata->about_id=$last_InsertId; 
    $detailsdata->heading=$request->detailheading[$i]; 
    $detailsdata->description =$request->detaildescription[$i];
    $sqlInsertdetails=$detailsdata->save();
    
            } //end for loop 
         
    
    }
         return redirect('manage-about/create')->with('success','Data saved sucessfully '); //create a session variable Success to store
         //amessage

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

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
$Data = aboutinfo::find($id);
$aboutdetailItems =DB::select('select * from about_details where about_id=:about_id order by id asc',["about_id"=>$id]);
   
 //returns a view which contains our form to display data to edit
    //pass data to page for editting
            //passing multiple data
   return view('pagesadmin.about_create')->with('detailItems',$aboutdetailItems)->with('DataToEdit', $Data);
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
        
      //handling the file upload
$upload_dir="about_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=$request->widthsize;
$fileNameToStore="nofile.png";
if(!empty($request->file('input_image'))){
$fileinput = $request->file('input_image');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}       
  
       
           //updating a service info data
           $data = aboutinfo::find($id); //so we will have to find a particular data
           $data->headingtext = $request->heading; //captured from form
           $data->widthsize = $request->widthsize; //captured from form
           $data->heightsize = $request->heightsize; //captured from form
           if($request->hasFile('input_image')){
                        //delete previous file
(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$data->filename);     
                $data->filename = $fileNameToStore;
               }

  $sqlupdate=$data->save();
    
    if($sqlupdate){

 //create and Initialize an empty array of selected ids
  //let's first delete ids of items which are not in this array
  $selected_ids = array();
  foreach ($request->itemid as $selected){
    if($selected!=0){
  $selected_ids[] = $selected; //add id's of submitted form fieldds
      }
      }
      if(count($selected_ids) > 0){//check if there are any id's in an array
          // Get the ids separated by comma
  $in_clause_ids = implode(", ", $selected_ids);
$sqlQuery =DB::delete('Delete from about_details where about_id=:id AND id NOT IN ('.$in_clause_ids.')',['id'=>$id]);
}
/////////////////////////////////////////////////

        //updating
for ($i = 0; $i < count($request->detaildescription); $i++) {

        if($request->itemid[$i] <= 0){
    //create new data
  $data = new about_details();
  $data->about_id=$id; 
  $data->heading= $request->detailheading[$i];
  $data->description= $request->detaildescription[$i];
  $data->save();
 }else{
  //update
 $data = about_details::find($request->itemid[$i]); 
  $data->about_id=$id; 
  $data->heading= $request->detailheading[$i];
  $data->description= $request->detaildescription[$i];
  $data->save();  
}//end else

        } //end for loop    
}
//////////////////////////////////////

return redirect('manage-about/'.$id.'/edit')->with('success','Data updated sucessfully '); //create a session variable Success to store
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
        $data = aboutinfo::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database
           if($data->filename != 'user.png'){
            Storage::delete('public/about_images/'.$data->filename);
            Storage::delete('public/about_images/thumbnails/'.$data->filename);
            }
       $deleted = $data->delete();

       if($deleted){
    //delete all the service_details having that service id and add them again
$sqlQuery =DB::delete('delete from about_details where about_id = ?',[$id]);
       }
        return redirect('manage-about')->with('success','Data deleted sucessfully '); //create a session variable Success to store
        //amessage
        //
    }



}
