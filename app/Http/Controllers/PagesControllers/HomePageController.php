<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Response;

use App\Models\activitiesinfo;
use App\Models\projectsinfo;
use App\Models\eventsinfo;
use App\Models\donationsinfo;


class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
   
       //var_dump($title);
      
 $SliderData =DB::select('select * from slider');
////////
$AboutinfoData =DB::select('select * from aboutinfo order by id asc limit 1');
$id=0;
if(count($AboutinfoData) > 0){
$id = $AboutinfoData[0]->id;
}
$About_detailsData =DB::select('select * from about_details where about_id=:id order by id asc limit 2',['id'=>$id]);
/////////
//////
   $DataDonationsInfo= donationsinfo::where('status', 1)->orderBy('id', 'asc')->limit(1)->get();
    $id=0;
if(count($DataDonationsInfo) > 0){
$id = $DataDonationsInfo[0]->id;
}
$Donation_detailsData =DB::select('select * from donations_details where related_id=:id order by id asc limit 2',['id'=>$id]);
/////////////

/////////////////////////////
 $Activitiesinfodata= activitiesinfo::where('status', 1)->orderBy('id', 'asc')->limit(3)->get();
////////////////////////////
 $Projectsinfodata= projectsinfo::where('status', 1)->orderBy('id', 'asc')->limit(3)->get();
/////////////////////
 $Eventsinfodata= eventsinfo::where('status', 1)->orderBy('id', 'asc')->limit(3)->get();

/////////////////////////////////


//////////////////////////////////////////
$TestimonialsData =DB::select('select  * from testimonials where status=1 limit 4');
//////////////////////////////////////////////////////////

    $title ="Home";
     return view('pages.index')->with('title',$title)
     ->with('SliderData',$SliderData)
     ->with('AboutinfoData',$AboutinfoData)
     ->with('About_detailsData',$About_detailsData)
     ->with('DataDonationsInfo',$DataDonationsInfo)
     ->with('Donation_detailsData',$Donation_detailsData)
     ->with('Activitiesinfodata',$Activitiesinfodata)
     ->with('Projectsinfodata',$Projectsinfodata)
     ->with('Eventsinfodata',$Eventsinfodata)
     ->with('TestimonialsData',$TestimonialsData);

    
    
    }

   
}
