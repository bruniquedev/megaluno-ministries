<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\content_info;
use App\Models\content_details;
use Response;
use App\AppHelper;
class MinistriesPageController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        
            $option="All";
     

      $MinistriesData = content_info::where('page_area_type', 'ministry')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();

$title="Ministries";
         return view('pages.ministriesdetails')
         ->with('DataInfo',$MinistriesData)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

 public function MinistryDetails($id,$title){

          $option="details";

$Ministrydetails= content_info::where('page_area_type', 'ministry')->where('ispublished', 1)->where('id',$id)->first();
$detailItems = content_details::where('related_id', $id)->orderBy('ordersort', 'asc')->get();
$relatedInfo= content_info::where('page_area_type', 'ministry')->where('ispublished', 1)->where('id', '!=', $id)->orderBy('sorted_order', 'asc')->get();

//dd($detailItems);
      return view('pages.ministriesdetails')
      ->with('Details',$Ministrydetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('title',ucfirst($Ministrydetails->title))
      ->with('option',$option);
}

}
