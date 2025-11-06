<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\projectsinfo;
use App\Models\projects_details;
use App\Models\donationsinfo;
use Response;
use App\AppHelper;

class ProjectsPageController extends Controller
{
   
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        
            $option="All";
     

     $Projectsinfodata= projectsinfo::where('status', 1)->orderBy('id', 'asc')->get();

          $title="Projects";
         return view('pages.projectsdetails')
         ->with('DataInfo',$Projectsinfodata)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

 public function ProjectDetails($id,$title){

          $option="details";
       //var_dump($title);
     
    $projectdetails= projectsinfo::where('status', 1)->where('id',$id)->get();

    $detailItems =DB::select('select * from projects_details where related_id=:related_id order by id asc',["related_id"=>$id]);

    $relatedInfo= projectsinfo::where('status', 1)->where('id', '!=', $id)->orderBy('id', 'asc')->get();

    $DataDonationsInfo= donationsinfo::where('status', 1)->orderBy('id', 'asc')->limit(1)->get();

      return view('pages.projectsdetails')
      ->with('Details',$projectdetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('DataDonationsInfo',$DataDonationsInfo)
      ->with('title',ucfirst($title))
      ->with('option',$option);
}


}
