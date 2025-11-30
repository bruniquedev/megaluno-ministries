<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContentService;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;// will enable us access storage 
use App\Models\content_info;
use App\Models\content_details;
use Illuminate\Support\Str;
use DB;//import if you want to use sql commands directly

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
     $data = content_info::where('page_area_type', 'partner')->get();   
 
  $Data = array(   

            'id'=>0,
            'title'=>'',
            'description'=>'',
            'iconfile'=>'',
            'icon_width'=>'100',
            'icon_height'=>'100'
            );
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
'description' => $request->link,
'page_area_type' => 'partner',
'slug' => Str::slug($request->title),
],
$request->allFiles());

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
    $Data =  content_info::find($id);
        $data = content_info::where('page_area_type', 'partner')->get();
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
  $content = (new ContentService())->saveContentInfo([
        'title' => $request->title,
        'description' => $request->link,
        'page_area_type' => 'partner',
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
           //
             $data = content_info::find($id);
           if($data->filename != ''){
            Storage::delete('public/content_uploads/'.$data->filename);
            Storage::delete('public/content_uploads/thumbnails/'.$data->filename);
            }
            if($data->iconfile != ''){
            Storage::delete('public/content_uploads/icons/'.$data->iconfile);
            //Storage::delete('public/content_uploads/icons/thumbnails/'.$data->iconfile);
            }
             if($data->featured_video != ''){
            Storage::delete('public/content_uploads/videos/'.$data->featured_video);
           // Storage::delete('public/content_uploads/videos/thumbnails/'.$data->featured_video);
            }
       $deleted = $data->delete();


       if($deleted){

$info = content_details::where('related_id', $id)->get();
if(count($info) >0){
  foreach($info as $Info){

    if($Info->filenamelist != ''){
    Storage::delete('public/content_uploads/details/'.$Info->filenamelist);
    Storage::delete('public/content_uploads/details/thumbnails/'.$Info->filenamelist);
    }
    if($Info->iconfilelist != ''){
    Storage::delete('public/content_uploads/details/'.$Info->iconfilelist);
    //Storage::delete('public/content_uploads/details/thumbnails/'.$Info->iconfilelist);
    }
     if($Info->video_filelist != ''){
    Storage::delete('public/content_uploads/details/'.$Info->video_filelist);
    // Storage::delete('public/content_uploads/details/thumbnails/'.$Info->video_filelist);
    }

}
}

$sqlQuery =DB::delete('delete from content_details where related_id = ?',[$id]);
       }
    return back()->with('success', 'Data deleted sucessfully!');
    }


    
}
