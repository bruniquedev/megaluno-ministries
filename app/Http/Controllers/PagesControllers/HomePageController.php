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

use App\Models\content_info;
use App\Models\content_details;

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
      
 $SliderData =content_info::where('page_area_type', 'slider')->where('ispublished', 1)->get();;
/////////////////////////////////////

 $HomeIntroData = content_info::where('page_area_type', 'home')->where('ispublished', 1)->get();
//$HomeIntro_detailsData = content_details::where('ispublishedlist', 1)->get();
$HomeIntro_detailsData = DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'home')->where('content_info.ispublished', 1)->get();
//dd($HomeIntro_detailsData);
//////////////////////////////////////

$SermonsData = content_info::where('page_area_type', 'sermon')->where('ispublished', 1)->orderBy('id', 'asc')->limit(3)->get();
//////////////////////////////////////////

$AboutinfoData = content_info::where('page_area_type', 'about')->where('ispublished', 1)->first();

$About_detailsData =  DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'about')->where('content_info.ispublished', 1)->orderBy('content_info.id', 'asc')->first();
//dd($About_detailsData);
/////////
//////
$DataDonationsInfo= content_info::where('page_area_type', 'donation')->where('ispublished', 1)->orderBy('id', 'asc')->limit(1)->get();
$Donation_detailsData = DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'donation')->where('content_info.ispublished', 1)->orderBy('content_info.id', 'asc')->limit(2)->get();
//////////////////////////////////////

$MinistriesData = content_info::where('page_area_type', 'ministry')->where('ispublished', 1)->orderBy('id', 'asc')->limit(3)->get();
//////////////////////////////////////////

$InvolvementData = content_info::where('page_area_type', 'involvement')->where('ispublished', 1)->orderBy('id', 'asc')->limit(3)->get();
//////////////////////////////////////////

/////////////////////
$Eventsinfodata = content_info::where('page_area_type', 'event')->where('ispublished', 1)->orderBy('id', 'asc')->limit(3)->get();
/////////////////////////////////


//////////////////////////////////////////
$TestimonialsData =DB::select('select  * from testimonials where status=1 limit 4');
//////////////////////////////////////////////////////////


    $title ="Home";
     return view('pages.index')->with('title',$title)
     ->with('SliderData',$SliderData)
     ->with('HomeIntroData',$HomeIntroData)
     ->with('HomeIntro_detailsData',$HomeIntro_detailsData)
     ->with('SermonsData',$SermonsData)
     ->with('AboutinfoData',$AboutinfoData)
     ->with('About_detailsData',$About_detailsData)
     ->with('DataDonationsInfo',$DataDonationsInfo)
     ->with('Donation_detailsData',$Donation_detailsData)
     ->with('MinistriesData',$MinistriesData)
     ->with('InvolvementData',$InvolvementData)
     ->with('Eventsinfodata',$Eventsinfodata)
     ->with('TestimonialsData',$TestimonialsData);

    
    
    }

   
}
