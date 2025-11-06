<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\pageview;
use App\Models\totalview;
use DB;//import if you want to use sql commands directly
class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
     public function handle(Request $request, Closure $next)
    {
        //handling visitor insertion  and page view updating 
        //$ip = $request->ip();
       $ip =$request->getClientIp();

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
          //ip from share internet
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          //ip pass from proxy
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }else{
          $ip = $_SERVER['REMOTE_ADDR'];
      }

       // $route = Route::currentRouteName();//get current page name/route name
        $route =$request->route()->getName();
        $pagetoview=$route;
        //fetch visitor details using page and userip
       // Visitor::where('page', $route)->where('userip', $ip)->count() < 1
      $details= pageview::where('page', $route)->where('userip', $ip)->count();

//var_dump($pagetoview); die();
        //if it does exist, then do nothing
//if($details->userip !="" && $details->created_at!=today()) {
if($details < 1) {
    
  /*
            $url ='https://www.iplocate.io/api/lookup/'.$ip;
            $request_url = $url;
            $curl = curl_init($request_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
             $response = curl_exec($curl);
            curl_close($curl);
            //print_r(json_decode($response));
            //var_dump($response); die();
  //$response = json_decode($response,true);
  $response = json_decode($response);
  */
  
    $url = @file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
//decode json data
$response = json_decode($url); 
//print_r($response); die();
  
  $country="";
  $country_code="";
  $city="";
  $continent="";
  $latitude="";
  $longitude="";
   date_default_timezone_set('Africa/Kampala');
  if(!empty($response) && $response->geoplugin_status!=404){ //should be uncommented on upgrading api
 //if(!empty($country)){//temporary
     //var_dump($response); die();
 $country=$response->geoplugin_countryName; //country; // 
  $country_code=$response->geoplugin_countryCode." ,".date('Y-m-d H:i:s'); //country_code; // 
  $city=$response->geoplugin_city; //city;
  $continent= $response->geoplugin_continentName; //continent; // 
  $latitude= $response->geoplugin_latitude; //latitude; // 37.751
  $longitude= $response->geoplugin_longitude; //longitude; // -97.822
  
 

   $visitdate=date('Y-m-d'); //H:i:s
     //$visitdate=now()->format('Y-m-d H:i:s');
  //insert the data
            pageview::create([
'page'=> $route,
'userip'=> $ip,
'country'=> $country,
'city'=> $city,
'countrycode'=> $country_code,
'latitude'=> $latitude,
'longitude'=> $longitude,
'visitdate'=> $visitdate
            ]);

            //make sure you register fillables in the Visitor model
            
           }   
        }
        
        $data = DB::select("select * from totalview where page='$pagetoview'");
        $page_view="";
        if(count($data) > 0){
     foreach($data as $data_returned){  
        $page_view=$data_returned->page;
            }
        }
           
          if($page_view !=$pagetoview){
             //insert
             totalview::create([
                'page'=> $route,
                'totalvisit'=>'1'
                    ]);
                //make sure you register fillables in the PageVisits model

          }else if($page_view == $pagetoview){
    $dataupdate = DB::update("Update totalview set totalvisit = totalvisit+1 where 
            page='$page_view'");
            //update

          }



        return $next($request);
    }
}


