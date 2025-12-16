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

class SearchengineController extends Controller
{
 use HandlesDeletion;    
use HasContentDefaults; 
 /**
     * Create a new controller instance.
     *
     * @return void
     */
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
  ////////////////////////////////////////////////////////////////
public function index()
{



 $data = content_info::where('page_area_type', 'seo')->orderBy('sorted_order', 'asc')->get();   
 
 //Override Only What You Want if you want to change something in the HasContentDefaults trait

// Base default values
    $defaults = HasContentDefaults::defaultContent();
     // Custom overrides or if you want to set some new defaults different from that of a trait
    $custom = [
        'ispublished' => "0", // overriding default
        'title' => ''  
    ];
    // Merge both
    $Data = array_merge($defaults, $custom);

     $Services_info = content_info::where('page_area_type', 'service')->get();
  $Sermons_info = content_info::where('page_area_type', 'sermon')->get();
  $Projects_info = content_info::where('page_area_type', 'project')->get();
  $programes_info = content_info::where('page_area_type', 'programe')->get();
  $Ministries_info = content_info::where('page_area_type', 'ministry')->get();
  $Involvements_info = content_info::where('page_area_type', 'involvement')->get();
  $Event_info = content_info::where('page_area_type', 'event')->get();
  $Activity_info = content_info::where('page_area_type', 'activity')->get();

return view('pagesadmin.searchengineoptimisation', [
        'DataToEdit' => $Data,
        'DataInfo' => $data,
        'Services_info'  => $Services_info,
        'Sermons_info' => $Sermons_info,
        'Projects_info' => $Projects_info,
        'Programes_info' => $programes_info,
        'Ministries_info' => $Ministries_info,
        'Involvements_info' => $Involvements_info,
        'Event_info' => $Event_info,
        'Activity_info' => $Activity_info
    ]);

} 

public function store(Request $request)
{

$content = (new ContentService())->saveContentInfo([
'detail_type' => $request->author,
'title' => $request->title,
'heading' => $request->keywordstext,   
'description' => $request->descriptiontext,
'page_area_type' => 'seo',
'isToresize' => 1,
'max_width' => 1000,
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
$data = content_info::where('page_area_type', 'seo')->orderBy('sorted_order', 'asc')->get(); 
 $Services_info = content_info::where('page_area_type', 'service')->get();
  $Sermons_info = content_info::where('page_area_type', 'sermon')->get();
  $Projects_info = content_info::where('page_area_type', 'project')->get();
  $programes_info = content_info::where('page_area_type', 'programe')->get();
  $Ministries_info = content_info::where('page_area_type', 'ministry')->get();
  $Involvements_info = content_info::where('page_area_type', 'involvement')->get();
  $Event_info = content_info::where('page_area_type', 'event')->get();
  $Activity_info = content_info::where('page_area_type', 'activity')->get();

          return view('pagesadmin.searchengineoptimisation')
                    ->with('DataToEdit',$Data)
                    ->with('DataInfo',$data)
                    ->with('Services_info',$Services_info)
                    ->with('Sermons_info',$Sermons_info)
                    ->with('Projects_info',$Projects_info)
                    ->with('Programes_info',$programes_info)
                    ->with('Ministries_info',$Ministries_info)
                    ->with('Involvements_info',$Involvements_info)
                    ->with('Event_info',$Event_info)
                    ->with('Activity_info',$Activity_info);
    
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
        'detail_type' => $request->author,
        'title' => $request->title,
        'heading' => $request->keywordstext,   
        'description' => $request->descriptiontext,
        'page_area_type' => 'seo',
        'isToresize' => 1,
        'max_width' => 1000,
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



    //
}