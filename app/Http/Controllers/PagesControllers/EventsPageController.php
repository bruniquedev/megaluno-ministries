<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\eventsinfo;
use App\Models\events_details;
use App\Models\donationsinfo;
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
     

     $eventsinfodata= eventsinfo::where('status', 1)->orderBy('id', 'asc')->get();

$title="Events";
         return view('pages.eventsdetails')
         ->with('DataInfo',$eventsinfodata)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

 public function EventDetails($id,$title){

          $option="details";
       //var_dump($title);
     
    $eventdetails= eventsinfo::where('status', 1)->where('id',$id)->get();

    $detailItems =DB::select('select * from events_details where related_id=:related_id order by id asc',["related_id"=>$id]);

    $relatedInfo= eventsinfo::where('status', 1)->where('id', '!=', $id)->orderBy('id', 'asc')->get();

    $DataDonationsInfo= donationsinfo::where('status', 1)->orderBy('id', 'asc')->limit(1)->get();

      return view('pages.eventsdetails')
      ->with('Details',$eventdetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('DataDonationsInfo',$DataDonationsInfo)
      ->with('title',ucfirst($title))
      ->with('option',$option);
}


}
