<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Response;
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
      
 $SliderData =content_info::where('page_area_type', 'slider')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();;
/////////////////////////////////////

 $HomeIntroData = content_info::where('page_area_type', 'home')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();
//$HomeIntro_detailsData = content_details::where('ispublishedlist', 1)->get();
$HomeIntro_detailsData = DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'home')->where('content_info.ispublished', 1)->orderBy('content_details.ordersort', 'asc')->get();
//dd($HomeIntro_detailsData);
//////////////////////////////////////

$SermonsData = content_info::where('page_area_type', 'sermon')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->limit(3)->get();
//dd($SermonsData);
//////////////////////////////////////////

$AboutinfoData = content_info::where('page_area_type', 'about')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->first();

$About_detailsData =  DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'about')->where('content_info.ispublished', 1)->orderBy('content_details.ordersort', 'asc')->first();
//dd($About_detailsData);
/////////
//////
$DataDonationsInfo= content_info::where('page_area_type', 'donation')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->first();
$Donation_detailsData = DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'donation')->where('content_info.ispublished', 1)->orderBy('content_details.ordersort', 'asc')->limit(2)->get();
//dd($Donation_detailsData);
//////////////////////////////////////

$MinistriesData = content_info::where('page_area_type', 'ministry')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->limit(3)->get();
//dd($MinistriesData);
//////////////////////////////////////////

$InvolvementData = content_info::where('page_area_type', 'involvement')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->limit(3)->get();
//////////////////////////////////////////

/////////////////////
$Eventsinfodata = content_info::where('page_area_type', 'event')->where('ispublished', "0")->orderBy('sorted_order', 'asc')->limit(3)->get();
//dd($Eventsinfodata);
/////////////////////////////////

$GalleryinfoData = content_info::where('page_area_type', 'gallery')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->first();


//////////////////////////////////////////
$TestimonialsData = content_info::where('page_area_type', 'review')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->limit(4)->get();
//////////////////////////////////////////////////////////
//dd($TestimonialsData);

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
     ->with('GalleryinfoData',$GalleryinfoData)
     ->with('TestimonialsData',$TestimonialsData);

    
    
    }

   
}
