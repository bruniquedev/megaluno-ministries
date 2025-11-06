<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\logo;
use App\AppHelper;
use DB;//import if you want to use sql commands directly
use Illuminate\Support\Facades\Storage;// will enable us access storage directory in 
//the public folder for deleting file purposes

class LogosController extends Controller
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
      //USING sql command directly, you must first import "use DB;" 
      $data =DB::select('select * from logo order by id desc');
              
      //for editting in the same form purposes
      $Data = array('text' =>'','filename' =>'', 'id' =>0);
      //var_dump($data);
      //passing multiple data
      return view('pagesadmin.logos')->with('DataInfo',$data)->with('DataToEdit', $Data);
    } 
    
    public function store(Request $request)
    {

            //handling the file upload
$upload_dir="logos_images";
$thumbnail_dir="thumbnails";
$isToresize=0;
$max_width=1000;
$fileNameToStore="nofile.png";
if(!empty($request->file('imagefile'))){
$fileinput = $request->file('imagefile');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}     
       

    
           //inserting data
        $data = new logo();
        $data->text = $request->descriptiontext; //captured from form
        $data->filename = $fileNameToStore; //captured from form
        $data->save();
         return redirect('manage-logos')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
            $data = logo::find($id); //so we will have to find a particular post  
            //here we are going to delete from the database
    
               //if slider_images in db not equal to noimage.jpg
               if($data->filename != 'nofile.png'){
                Storage::delete('public/logos_images/'.$data->filename);
                }
                
            $data->delete();
            return redirect('manage-logos')->with('success','Data deleted sucessfully '); //create a session variable Success to store
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
            $Data = logo::find($id);
            $data =DB::select('select * from logo order by id desc');
            //var_dump($data);
            //pass data to page for editting
             //passing multiple data
              return view('pagesadmin.logos')->with('DataToEdit',$Data)->with('DataInfo',$data);
        
        }
     public function show($id)
    {
        //returns a view which contains our form to display data to edit
        $Data = logo::find($id);
           $status=0;
          if($Data->status==0){
            $status = 1;
          }
          if($Data->status==1){
            $status = 0;
          }
         $Data->status=$status;
        $Data->save();
        //var_dump($data);
        //pass data to page for editting
         //passing multiple data
         return redirect('manage-logos')->with('success','Data updated sucessfully '); //create a session variable Success to store
       
    
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
$upload_dir="logos_images";
$thumbnail_dir="thumbnails";
$isToresize=0;
$max_width=1000;
$fileNameToStore="nofile.png";
if(!empty($request->file('imagefile'))){
$fileinput = $request->file('imagefile');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}   
    
               //updating a testimonials data
               $data = logo::find($id); //so we will have to find a particular data
               $data->text = $request->descriptiontext; //captured from form
                 //check if user has opted to upload the file
                 if($request->hasFile('imagefile')){
                                                    //delete previous file
(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$data->filename); 
                    $data->filename = $fileNameToStore;
                   }
               $data->save();
    
        //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
                return redirect('manage-logos')->with('success','Data updated sucessfully '); //create a session variable Success to store
                //amessage
        }
    
    
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////
    
    
    
        //
    }
    
    
    
    