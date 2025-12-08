<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\content_info;
use App\Models\content_details;
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
            $WebsiteLogoData = content_info::where('page_area_type', 'logo')->where('ispublished', 1)->first();
            $ContactsSetupData =DB::select("SELECT * FROM contacts ORDER BY FIELD(detailtype, 'Tel', 'WhatsApp number', 'Email', 'WhatsApp link', 'Address', 'Map', 'Footer detail')");
            $SocialLinksData = content_info::where('page_area_type', 'sociallink')->where('ispublished', 1)->get();
            $SEOData =DB::select('select * from seo');
            $PartnersData = content_info::where('page_area_type', 'partner')->where('ispublished', 1)->get();

                $Ministriesinfodata= content_info::where('page_area_type', 'ministry')->where('ispublished', 1)->orderBy('id', 'asc')->get();
                $Involvementinfodata= content_info::where('page_area_type', 'involvement')->where('ispublished', 1)->orderBy('id', 'asc')->get();

                 $visittime= date('Y-m-d');
                 $TodayTotalCountvisitors =DB::select('select distinct userip from pageview where visitdate =:visitdate', ['visitdate' => $visittime]);
                $Unreaddonations =DB::select('select * from donations where donationstatus=0');
                $Unreadmessages =DB::select('select * from messages where seenstatus=0');
                $Unreadreviews =DB::select('select * from testimonials where status=0');               
$LogoIcon="";
$Brandname="";
if($WebsiteLogoData){
$LogoIcon=$WebsiteLogoData->iconfile;
$Brandname=$WebsiteLogoData->title;
}

                View::share('LogoIcon', $LogoIcon);
                View::share('Brandname', $Brandname);
                View::share('ContactsSetupData', $ContactsSetupData);
                View::share('WebsiteLogoData', $WebsiteLogoData);
                View::share('SocialLinksData', $SocialLinksData);
                View::share('SEOData', $SEOData);
                View::share('MinistriesInfoData',$Ministriesinfodata);
                View::share('InvolvementInfoData',$Involvementinfodata);
                View::share('PartnersData', $PartnersData);
                View::share('TodayTotalCountvisitors',count($TodayTotalCountvisitors));
                View::share('Unreaddonations', $Unreaddonations);
                View::share('Unreadmessages', $Unreadmessages);
                View::share('Unreadreviews', $Unreadreviews);
                

                return $next($request);
            });
            }


}
