<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContentService;
use App\Traits\HandlesDeletion;
use App\Traits\HasContentDefaults;
use DB;
use DateTime;
use Hash;
use Response;
use App\Models\content_info;
use App\Models\content_details;
use Illuminate\Support\Str;
class TestimonialsPageController extends Controller
{
    public function Index()
    {

        $TestimonialsData = content_info::where('page_area_type', 'review')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();
       $title ="Testimonials";
       //var_dump($title);
      return view('pages.testimonials')->with('title',$title)->with('TestimonialsData',$TestimonialsData); 
    }



    public function postUserTestimonial(Request $request)
    {

$date=new DateTime('NOW');
$currentDate=date_format($date,"Y-m-d H:i:s");
        /*
only allowed html and php name attributes for files
input_file
input_icon
input_video

input_filelist
input_iconlist
input_videolist
*/
$content = (new ContentService())->saveContentInfo([
'heading' => $request->reviewername,   
'title' => $request->jobtitle,
'description' => $request->reviewmessage,
'email_address' => $request->reviewemail,
'ratings' => $request->rating,
'day_date' => $currentDate,
'ispublished' => "0",
'page_area_type' => 'review',
'isToresize' => 1,
'max_width' => 1000,
],
$request->allFiles());

    return redirect('testimonials')->with('success','Testimonial sent sucessfully ');
    }



}
