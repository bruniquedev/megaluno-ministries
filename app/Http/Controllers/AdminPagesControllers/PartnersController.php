<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\partners;
use App\AppHelper;
use DB;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller
{


 public function __construct()
    {     
 parent::__construct();  
$this->middleware('auth:megalunaadmin');//un comment if you want to limit
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //USING sql command directly, you must first import "use DB;" 
      $data =DB::select('select * from partners order by id desc');
              
      //for editting in the same form purposes
      $Data = array('text' =>'','filename' =>'','link' =>'', 'id' =>0);
      //var_dump($data);
      //passing multiple data
      return view('pagesadmin.partners')->with('DataInfo',$data)->with('DataToEdit', $Data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

$upload_dir="partners_images";
$thumbnail_dir="thumbnails";
$isToresize=0;
$max_width=1000;
$fileNameToStore="nofile.png";
if(!empty($request->file('imagefile'))){
$fileinput = $request->file('imagefile');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}

    
           //inserting data
        $data = new partners();
        $data->text = $request->descriptiontext; //captured from form
        $data->filename = $fileNameToStore; //captured from form
        $data->link = $request->link; //captured from form
        $data->save();
         return redirect('manage-partnerlogos')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
            $Data = partners::find($id);
            $data =DB::select('select * from partners order by id desc');
            //var_dump($data);
              return view('pagesadmin.partners')->with('DataToEdit',$Data)->with('DataInfo',$data);
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
        $upload_dir="partners_images";
$thumbnail_dir="thumbnails";
$isToresize=0;
$max_width=1000;
$fileNameToStore="nofile.png";
if(!empty($request->file('imagefile'))){
$fileinput = $request->file('imagefile');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}

            
    
               //updating a testimonials data
               $data = partners::find($id); //so we will have to find a particular data
               $data->text = $request->descriptiontext; //captured from form
                $data->link = $request->link; //captured from
                 //check if user has opted to upload the file
                 if($request->hasFile('imagefile')){

      //delete previous file
(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$data->filename);  
                    $data->filename = $fileNameToStore;
                   }
               $data->save();
    
        //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
                return redirect('manage-partnerlogos')->with('success','Data updated sucessfully '); //create a session variable Success to store
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
          $data = partners::find($id); //so we will have to find a particular post  
            //here we are going to delete from the database
    
               //if slider_images in db not equal to noimage.jpg
               if($data->filename != 'user.png'){
                Storage::delete('public/partners_images/'.$data->filename);
                }
                
            $data->delete();
            return redirect('manage-partnerlogos')->with('success','Data deleted sucessfully '); //create a session variable Success to store
            //amessage
            //
    }
}
