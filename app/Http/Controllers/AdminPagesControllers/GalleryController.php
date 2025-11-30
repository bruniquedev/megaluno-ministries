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

class GalleryController extends Controller
{

 use HandlesDeletion;    
use HasContentDefaults; 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){        
 parent::__construct(); 
$this->middleware('auth:megalunaadmin');//un comment if you want to limit
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   ////////////////////////////////////////////////////////////////
public function index()
{
     $data = content_info::where('page_area_type', 'gallery')->get();   
 
 //Override Only What You Want if you want to change something in the HasContentDefaults trait

// Base default values
    $defaults = HasContentDefaults::defaultContent();
     // Custom overrides or if you want to set some new defaults different from that of a trait
    $custom = [
        'ispublished' => 1, // overriding default
        'title' => ''  
    ];
    // Merge both
    $Data = array_merge($defaults, $custom);

return view('pagesadmin.gallery', [
        'DataToEdit' => $Data,
        'DataInfo' => $data
    ]);
} 

public function store(Request $request)
{

        /*
only allowed html and php name attributes for files
input_file
input_icon
input_video

input_filelist
input_iconlist
input_videolist
*/
$content = (new ContentService())->saveContentInfo([
'title' => $request->title,
'description' => $request->description,
'page_area_type' => 'gallery',
'slug' => Str::slug($request->title),
],
$request->allFiles());



  return back()->with('success', 'Content saved!');
}

 




 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Data =  content_info::find($id);
        $data = content_info::where('page_area_type', 'gallery')->get();  
          return view('pagesadmin.gallery')->with('DataToEdit',$Data)->with('DataInfo',$data);
    
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


$content = (new ContentService())->saveContentInfo([
        'title' => $request->title,
        'description' => $request->description,
        'page_area_type' => 'gallery',
        'slug' => Str::slug($request->title),
    ],
    $request->allFiles(),
    $id);


return back()->with('success', 'Content saved!');

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
}
