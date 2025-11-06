<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\testimonials;//must be imported
use DB;//import if you want to use sql commands directly
use DateTime;
class TestimonialsPageController extends Controller
{
    public function Index()
    {

        $TestimonialsData =DB::select('select  * from testimonials where status=1');
       $title ="Testimonials";
       //var_dump($title);
      return view('pages.testimonials')->with('title',$title)->with('TestimonialsData',$TestimonialsData); 
    }



    public function postUserTestimonial(Request $request)
    {

        $date=new DateTime('NOW');
//$currentDate=date_format($date,"Y-m-d"); 
$currentDate=date_format($date,"Y-m-d H:i:s");//24hr
        //let's try to store our data using tinker like commands here
        //
           //inserting data
        $data = new testimonials;
        $data->name = $request->reviewername; //captured from form
        $data->email = $request->reviewemail;//captured from form
        $data->descriptiontext = $request->reviewmessage;//captured from form
        $data->ratings = $request->rating;//captured from form
        $data->reviewdate = $currentDate;
        $data->status =0;
        $data->save();
         return redirect('testimonials')->with('success','Testimonial sent sucessfully '); //create a session variable Success to store
         //amessage
    }



}
