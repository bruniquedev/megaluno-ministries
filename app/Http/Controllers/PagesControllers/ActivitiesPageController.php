<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\activitiesinfo;
use App\Models\activities_details;
use App\Models\donationsinfo;
use Response;
use App\AppHelper;


class ActivitiesPageController extends Controller
{
    

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        
            $option="All";
     

     $Activitiesinfodata= activitiesinfo::where('status', 1)->orderBy('id', 'asc')->get();

$title="Activities";
         return view('pages.activitiesdetails')
         ->with('DataInfo',$Activitiesinfodata)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

 public function ProgrammeDetails($id,$title){

          $option="details";
       //var_dump($title);
     
    $activitydetails= activitiesinfo::where('status', 1)->where('id',$id)->get();

    $detailItems =DB::select('select * from activities_details where related_id=:related_id order by id asc',["related_id"=>$id]);

    $relatedInfo= activitiesinfo::where('status', 1)->where('id', '!=', $id)->orderBy('id', 'asc')->get();
  $DataDonationsInfo= donationsinfo::where('status', 1)->orderBy('id', 'asc')->limit(1)->get();
      return view('pages.activitiesdetails')
      ->with('Details',$activitydetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('DataDonationsInfo',$DataDonationsInfo)
      ->with('title',ucfirst($title))
      ->with('option',$option);
}



}
