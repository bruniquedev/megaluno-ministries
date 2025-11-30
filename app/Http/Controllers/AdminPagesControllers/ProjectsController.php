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
class ProjectsController extends Controller
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

$data = content_info::where('page_area_type', 'project')->get();

         return view('pagesadmin.projects')->with('DataInfo',$data);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

return view('pagesadmin.project_create', [
        'DataToEdit' => $Data,
        'ListdetailItems' => $this->defaultDetailItems()
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
'page_area_type' => 'project',
'slug' => Str::slug($request->title),
],
$request->allFiles());


$details = [];
foreach ($request->ordersortlist as $i => $ordersort) {
    $details[] = [
        'id' => $request->itemidlist[$i] ?? null,
        'ordersort' => $ordersort,
        'headinglist' => $request->detailheadinglist[$i],
        'descriptionlist' => $request->detaildescriptionlist[$i],
        'input_filelist' => $request->input_filelist[$i] ?? null,
        'sluglist' => Str::slug($request->detailheadinglist[$i])
    ];
}

    (new ContentService())->saveContentDetails(
       contentId: $content->id,
       details: $details            
    );


  return back()->with('success', 'Content saved!');

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
$Data = content_info::find($id);
$detailItems =DB::select('select * from content_details where related_id=:related_id order by ordersort asc',["related_id"=>$id]);

   return view('pagesadmin.project_create')->with('ListdetailItems',$detailItems)->with('DataToEdit', $Data);
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
        $content = (new ContentService())->saveContentInfo([
        'title' => $request->title,
        'description' => $request->description,
        'page_area_type' => 'project',
        'slug' => Str::slug($request->title),
    ],
    $request->allFiles(),
    $id);



   $details = [];
foreach ($request->ordersortlist as $i => $ordersort) {
    $details[] = [
        'id' => $request->itemidlist[$i] ?? null,
        'ordersort' => $ordersort,
        'headinglist' => $request->detailheadinglist[$i],
        'descriptionlist' => $request->detaildescriptionlist[$i],
        'input_filelist' => $request->input_filelist[$i] ?? null,
        'sluglist' => Str::slug($request->detailheadinglist[$i])
    ];
}

    (new ContentService())->saveContentDetails(
       contentId: $content->id,
       details: $details            
    );


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


}
