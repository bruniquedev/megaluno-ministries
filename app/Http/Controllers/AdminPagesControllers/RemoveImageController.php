<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;//import if you want to use sql commands directly
use Hash;
use Response;
use DateTime;
use App\AppHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;// will enable us access storage 
use App\Models\content_info;
use App\Models\content_details;

class RemoveImageController extends Controller
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
      
   //register admin guard in the config\auth.php   
$this->middleware('auth:megalunaadmin');//un comment if you want to limit
    }



    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


public function RemoveImage(Request $request){

$html="";
$message="";
$status=0;
  $response = array(); 


$id=$request->id;
$table=$request->table;
$column=$request->column;

if($table=='content_info'){
 $data = content_info::find($id);

    if($data->filename != '' && $column=='filename'){
    Storage::delete('public/content_uploads/'.$data->filename);
    Storage::delete('public/content_uploads/thumbnails/'.$data->filename);
     $data->filename = '';
    }
    if($data->iconfile != '' && $column=='iconfile'){
    Storage::delete('public/content_uploads/icons/'.$data->iconfile);
    //Storage::delete('public/content_uploads/icons/thumbnails/'.$data->iconfile);
    $data->iconfile = '';
    }
     if($data->featured_video != '' && $column=='featured_video'){
    Storage::delete('public/content_uploads/videos/'.$data->featured_video);
    // Storage::delete('public/content_uploads/videos/thumbnails/'.$data->featured_video);
    $data->featured_video = '';
    }
    $data->save();
    $status= 1;
    $message="file removed successfully";
}

if($table=='content_details'){
 $data = content_details::find($id);
  
   if($data->filenamelist != '' && $column=='filenamelist'){
    Storage::delete('public/content_uploads/details/'.$data->filenamelist);
    Storage::delete('public/content_uploads/details/thumbnails/'.$data->filenamelist);
     $data->filenamelist = '';
    }
    if($data->iconfilelist != '' && $column=='iconfilelist'){
    Storage::delete('public/content_uploads/details/'.$data->iconfilelist);
    //Storage::delete('public/content_uploads/details/thumbnails/'.$data->iconfilelist);
     $data->iconfilelist = '';
    }
     if($data->video_filelist != '' && $column=='video_filelist'){
    Storage::delete('public/content_uploads/details/'.$data->video_filelist);
    // Storage::delete('public/content_uploads/details/thumbnails/'.$data->video_filelist);
     $data->video_filelist = '';
    }
     $data->save();
     $status= 1;
     $message="file removed successfully";
}

$response = array(
    "id" => $id,
    "status" => $status,
     "message" => $message);
    
     return Response::json($response); 
}








}
