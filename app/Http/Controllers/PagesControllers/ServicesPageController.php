<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\servicesinfo;
use App\Models\service_details;
use App\Models\services_features;
use DB;//import if you want to use sql commands directly

class ServicesPageController extends Controller
{
    public function Index($name)
    {

      $Service_Data =DB::select('select * from servicesinfo where name=:name',["name"=>$name]);
      $servicedetailItems =DB::select('select * from service_details where service_id=:service_id order by id asc',["service_id"=>$Service_Data[0]->id]);
        
        $Services =DB::select('select * from servicesinfo');

       $title =$name;
       //var_dump($title);
      return view('pages.services')->with('title',$title)
      ->with('servicedetailItems',$servicedetailItems)
      ->with('Service_Data', $Service_Data)
      ->with('Services', $Services);
    }

}
