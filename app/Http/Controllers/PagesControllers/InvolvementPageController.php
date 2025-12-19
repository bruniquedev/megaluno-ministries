<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\content_info;
use App\Models\content_details;
use Response;
use App\AppHelper;

class InvolvementPageController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        
            $option="All";
     

       $InvolvementData = content_info::where('page_area_type', 'involvement')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();

          $title="GET INVOLVED";
         return view('pages.involvementsdetails')
         ->with('DataInfo',$InvolvementData)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

 public function InvolvementDetails($id,$title){

          $option="details";
       //var_dump($title);

$Involvementdetails= content_info::where('page_area_type', 'involvement')->where('ispublished', 1)->where('id',$id)->first();
$detailItems = content_details::where('related_id', $id)->orderBy('ordersort', 'asc')->get();
$relatedInfo= content_info::where('page_area_type', 'involvement')->where('ispublished', 1)->where('id', '!=', $id)->orderBy('sorted_order', 'asc')->get();

//dd($detailItems);
      return view('pages.involvementsdetails')
      ->with('Details',$Involvementdetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('title',ucfirst($Involvementdetails->title))
      ->with('option',$option);

}

}
