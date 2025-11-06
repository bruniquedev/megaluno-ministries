<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;//import if you want to use sql commands directly
class AboutPageController extends Controller
{
    public function Index()
    {


      $About_detailsData =DB::select('select * from about_details order by id asc');
      $AboutinfoData =DB::select('select * from aboutinfo order by id asc');


       $title ="About";
       //var_dump($title);
      return view('pages.about')
      ->with('title',$title)
      ->with('AboutinfoData',$AboutinfoData)
      ->with('About_detailsData',$About_detailsData);
    }

}
