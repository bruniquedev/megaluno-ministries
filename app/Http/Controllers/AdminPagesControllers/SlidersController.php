<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\slider;
use App\AppHelper;
use DB;//import if you want to use sql commands directly
use Illuminate\Support\Facades\Storage;// will enable us access storage directory in 
//the public folder for deleting file purposes

class SlidersController extends Controller
{

 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
 parent::__construct();  
$this->middleware('auth:blessingheartadmin');//un comment if you want to limit
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
  $data =DB::select('select * from slider order by id asc');
  		
  //for editting in the same form purposes
  $Data = array('headingtext'=>'','text' =>'','filename' =>'','buttontext' =>'','buttonlink' =>'', 'id' =>0);
  //var_dump($data);
  //passing multiple data
  return view('pagesadmin.sliders')->with('DataInfo',$data)->with('DataToEdit', $Data);
} 

public function store(Request $request)
{

        //handling the file upload
$upload_dir="slider_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=1000;
$fileNameToStore="nofile.png";
if(!empty($request->file('imagefile'))){
$fileinput = $request->file('imagefile');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
} 
   
       //inserting data
    $data = new slider();
    $data->text = $request->descriptiontext; //captured from form
    $data->headingtext = $request->headingtext; //captured from form
    $data->buttontext = $request->buttontext;
    $data->buttonlink = $request->buttonlink;
    $data->filename = $fileNameToStore; //captured from form
    $data->save();
     return redirect('manage-sliders')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
        $data = slider::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database

           //if slider_images in db not equal to noimage.jpg
           if($data->filename != 'user.png'){
            Storage::delete('public/slider_images/'.$data->filename);
            Storage::delete('public/slider_images/thumbnails/'.$data->filename);
            }
            
        $data->delete();
        return redirect('manage-sliders')->with('success','Data deleted sucessfully '); //create a session variable Success to store
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
        $Data = slider::find($id);
        $data =DB::select('select * from slider order by id asc');
        //var_dump($data);
        //pass data to page for editting
         //passing multiple data
          return view('pagesadmin.sliders')->with('DataToEdit',$Data)->with('DataInfo',$data);
    
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
$upload_dir="slider_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=1000;
$fileNameToStore="nofile.png";
if(!empty($request->file('imagefile'))){
$fileinput = $request->file('imagefile');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
} 


           //updating a testimonials data
           $data = slider::find($id); //so we will have to find a particular data
           $data->text = $request->descriptiontext; //captured from form
           $data->headingtext = $request->headingtext; //captured from form
            $data->buttontext = $request->buttontext;
            $data->buttonlink = $request->buttonlink;
             //check if user has opted to upload the file
             if($request->hasFile('imagefile')){
                                //delete previous file
(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$data->filename); 
                $data->filename = $fileNameToStore;
               }
           $data->save();

    //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
            return redirect('manage-sliders')->with('success','Data updated sucessfully '); //create a session variable Success to store
            //amessage
    }






///////////////////////////////////////////////////////////////////////////////////////



    //
}


