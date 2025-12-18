<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;//import if you want to use sql commands directly
use App\Models\content_info;
use App\Models\content_details;
use Response;
use App\AppHelper;
class AboutPageController extends Controller
{
    public function Index()
    {

 $AboutinfoData = content_info::where('page_area_type', 'about')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();
$About_detailsData =  DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'about')->where('content_info.ispublished', 1)->orderBy('content_details.ordersort', 'asc')->get();

//dd($About_detailsData);

       $title ="About";
       //var_dump($title);
      return view('pages.about')
      ->with('title',$title)
      ->with('AboutinfoData',$AboutinfoData)
      ->with('About_detailsData',$About_detailsData);
    }

}
