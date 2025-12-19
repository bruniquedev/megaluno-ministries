<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\content_info;
use App\Models\content_details;
use Response;
use App\AppHelper;

class EventsPageController extends Controller
{
    
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        
            $option="All";
     

 $eventsinfodata = content_info::where('page_area_type', 'event')->where('ispublished', "0")->orderBy('sorted_order', 'asc')->get();


$title="Events";
         return view('pages.eventsdetails')
         ->with('DataInfo',$eventsinfodata)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

 public function EventDetails($id,$title){

          $option="details";
       //var_dump($title);


$eventdetails= content_info::where('page_area_type', 'event')->where('ispublished', "0")->where('id',$id)->first();
$detailItems = content_details::where('related_id', $id)->orderBy('ordersort', 'asc')->get();
$relatedInfo= content_info::where('page_area_type', 'event')->where('ispublished', "0")->where('id', '!=', $id)->orderBy('sorted_order', 'asc')->get();

//dd($eventdetails);
      return view('pages.eventsdetails')
      ->with('Details',$eventdetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('title',ucfirst($eventdetails->title))
      ->with('option',$option);
}


}
