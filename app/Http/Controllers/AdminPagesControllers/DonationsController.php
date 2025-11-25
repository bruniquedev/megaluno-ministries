<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\donations;
use App\Models\donationsinfo;
use App\Models\donations_details;
use App\AppHelper;
use Illuminate\Support\Facades\Storage;
class DonationsController extends Controller
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

        $data= donationsinfo::orderBy('id', 'asc')->get();
        //passing multiple data
        return view('pagesadmin.donation_info')->with('DataInfo',$data);
    }

     public function UsersDonations()
    {

        $data= donations::orderBy('id', 'desc')->get();
        //passing multiple data
        return view('pagesadmin.donations_records')->with('DataInfo',$data);
    }

         public function Update_donationstatus($id)
    {
        //returns a view which contains our form to display data to edit
        $Data = donations::find($id);
            //var_dump($Data); die();
          if($Data->status==0){
            $Data->status=1;
          }else if($Data->status==1){
            $Data->status=0;
          }
          $Data->save();

    return redirect('users-donations')->with('success','Data updated sucessfully '); //create a session variable Success to store
    
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
            'descriptiontext'=>'',
            'filename'=>'',
            'widthsize'=>'600',
            'heightsize'=>'350'
            );
            
            $detailItems= array();
 return view('pagesadmin.donation_info_create')->with('detailItems',$detailItems)->with('DataToEdit', $Data);
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
$upload_dir="donations_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=$request->widthsize;
$fileNameToStore="nofile.png";
if(!empty($request->file('input_image'))){
$fileinput = $request->file('input_image');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}       
    
           //inserting data
        $data = new donationsinfo();
        $data->headingtext = $request->heading; //captured from form
        $data->descriptiontext = $request->descriptiontext;
        $data->widthsize = $request->widthsize; //captured from form
        $data->heightsize = $request->heightsize; //captured from form
        $data->filename = $fileNameToStore; //captured from form
        $sqlInsert=$data->save();
        
        if($sqlInsert){
    
          $last_InsertId =$data->id;//this get's the just inserted id;
    //saving service details
    for ($i = 0; $i < count($request->detaildescription); $i++) {
    $detailsdata = new donations_details();
    $detailsdata->related_id=$last_InsertId; 
    $detailsdata->heading=$request->detailheading[$i]; 
    $detailsdata->description =$request->detaildescription[$i];
    $sqlInsertdetails=$detailsdata->save();
    
            } //end for loop 
         
    
    }
         return redirect('manage-donations/create')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
           $Data = donationsinfo::find($id);
            //var_dump($Data); die();
          if($Data->status==0){
            $Data->status=1;
          }else if($Data->status==1){
            $Data->status=0;
          }
          $Data->save();

    return redirect('manage-donations')->with('success','Data updated sucessfully ');
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
$Data = donationsinfo::find($id);
$detailItems =DB::select('select * from donations_details where related_id=:related_id order by id asc',["related_id"=>$id]);

   return view('pagesadmin.donation_info_create')->with('detailItems',$detailItems)->with('DataToEdit', $Data);
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
$upload_dir="donations_images";
$thumbnail_dir="thumbnails";
$isToresize=1;
$max_width=$request->widthsize;
$fileNameToStore="nofile.png";
if(!empty($request->file('input_image'))){
$fileinput = $request->file('input_image');
$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
}       
  
       
           //updating a service info data
           $data = donationsinfo::find($id); //so we will have to find a particular data
           $data->headingtext = $request->heading; //captured from form
           $data->descriptiontext = $request->descriptiontext;
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
$sqlQuery =DB::delete('Delete from donations_details where related_id=:id AND id NOT IN ('.$in_clause_ids.')',['id'=>$id]);
}
/////////////////////////////////////////////////

        //updating
for ($i = 0; $i < count($request->detaildescription); $i++) {

        if($request->itemid[$i] <= 0){
    //create new data
  $data = new donations_details();
  $data->related_id=$id; 
  $data->heading= $request->detailheading[$i];
  $data->description= $request->detaildescription[$i];
  $data->save();
 }else{
  //update
 $data = donations_details::find($request->itemid[$i]); 
  $data->related_id=$id; 
  $data->heading= $request->detailheading[$i];
  $data->description= $request->detaildescription[$i];
  $data->save();  
}//end else

        } //end for loop   
}
//////////////////////////////////////
return redirect('manage-donations/'.$id.'/edit')->with('success','Data updated sucessfully '); //create a session variable Success to store
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
         $data = donationsinfo::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database
           if($data->filename != 'user.png'){
            Storage::delete('public/donations_images/'.$data->filename);
            Storage::delete('public/donations_images/thumbnails/'.$data->filename);
            }
       $deleted = $data->delete();

       if($deleted){
$sqlQuery =DB::delete('delete from donations_details where related_id = ?',[$id]);
       }
        return redirect('manage-donations')->with('success','Data deleted sucessfully '); //create a session variable Success to store
        //amessage
        //
    }

}
