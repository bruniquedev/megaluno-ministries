<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\activitiesinfo;
use App\Models\projectsinfo;
use DB;//import if you want to use sql commands directly
use Illuminate\Support\Facades\View;
use Session;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct() {


        //No session access from constructor work arround
           $this->middleware(function ($request, $next){
       
           //let's share some data globally
                $WebsiteLogoData =DB::select('select * from logo where status=1');
                $ContactsSetupData =DB::select("SELECT * FROM contacts
ORDER BY FIELD(detailtype, 'Tel', 'WhatsApp number', 'Email', 'WhatsApp link', 'Address', 'Map', 'Footer detail')");
                $SocialLinksData =DB::select('select * from sociallinks');
                $SEOData =DB::select('select * from seo');
               // $ServiceData =DB::select('select * from servicesinfo');
                $PartnersData =DB::select('select * from partners');

                $Activitiesinfodata= activitiesinfo::where('status', 1)->orderBy('id', 'asc')->get();
                $Projectsinfodata= projectsinfo::where('status', 1)->orderBy('id', 'asc')->get();

                 $visittime= date('Y-m-d');
                 $TodayTotalCountvisitors =DB::select('select distinct userip from pageview where visitdate =:visitdate', ['visitdate' => $visittime]);
                $Unreaddonations =DB::select('select * from donations where donationstatus=0');
                $Unreadmessages =DB::select('select * from messages where seenstatus=0');
                $Unreadreviews =DB::select('select * from testimonials where status=0');               
$Logoname="";
$Brandname="";
if(count($WebsiteLogoData) > 0){
$Logoname=$WebsiteLogoData[0]->filename;
$Brandname=$WebsiteLogoData[0]->text;
}

                View::share('Logoname', $Logoname);
                View::share('Brandname', $Brandname);
                View::share('ContactsSetupData', $ContactsSetupData);
                View::share('WebsiteLogoData', $WebsiteLogoData);
                View::share('SocialLinksData', $SocialLinksData);
                View::share('SEOData', $SEOData);
              //View::share('ServiceData', $ServiceData);
                View::share('Activitiesinfo',$Activitiesinfodata);
                View::share('Projectsinfo',$Projectsinfodata);
                View::share('PartnersData', $PartnersData);
                View::share('TodayTotalCountvisitors',count($TodayTotalCountvisitors));
                View::share('Unreaddonations', $Unreaddonations);
                View::share('Unreadmessages', $Unreadmessages);
                View::share('Unreadreviews', $Unreadreviews);
                

                return $next($request);
            });
            }


}
