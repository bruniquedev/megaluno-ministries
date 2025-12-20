<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendContactformEmail;
use Illuminate\Support\Facades\Mail;
use DB;
use DateTime;
use Hash;
use Response;
use App\Models\content_info;
use App\Models\content_details;
use Illuminate\Support\Str;

class ContactPageController extends Controller
{
    public function Index()
    {
       $title ="Contacts";
       //var_dump($title);
      return view('pages.contacts')->with('title',$title); 
    }



/**
     * Write code on Method
     *
     * @return response()
     */
    public function postUserContactMessage(Request $request)
    {

$response = array();      
$message ="";
$status_message ="false";
  $data = new content_info();       

$Name = "Anonymous";
$Phone = "Anonymous";

if($request->Name!=""){
$Name = $request->Name;
}
if($request->phonenumber!=""){
$Phone = $request->phonenumber;
}


$data->title= $Name;
$data->email_address= $request->email;  
$data->phone_number = $Phone;
$data->heading = $request->subject;
$data->description = $request->message;
$data->day_date= date('Y-m-d H:i:s'); 
$data->status = 0; 
$data->page_area_type = "message";
$data->save();
$message="Thank you for contacting us, we will get back to you as soon as possible.";
$status_message ="true";



$ContactsSetupData = content_info::where('page_area_type', 'contactsetup')->where('detail_type', 'Email')->orderBy('sorted_order', 'asc')->first(); 

$receiveremail = "bruniquedevelopers@gmail.com";
if($ContactsSetupData->description){
$receiveremail = $ContactsSetupData->description;
}

$WebsiteLogoData = content_info::where('page_area_type', 'logo')->orderBy('sorted_order', 'asc')->first(); 
$receiver = "";
if($WebsiteLogoData->title){
$receiver = $WebsiteLogoData->title;
}

$subject = $receiver." contact form message from ".$Name;
 $Mailobj = new \stdClass();
        $Mailobj->sendermail = $request->email;
        $Mailobj->sender = $Name;
        $Mailobj->subject = $request->subject;
        $Mailobj->message = $request->message;
        $Mailobj->senderphone = $Phone;
        $Mailobj->receiveremail = $receiveremail;
        $Mailobj->receiver = $receiver;
        
        //Mail::to("receiver@example.com")->send(new DemoEmail($objDemo
        if (Is_internet_connected()){
      $result=  Mail::to($receiveremail)->send(new SendContactformEmail($Mailobj));
  }
     
$response = array(
"message" => $message,
"status_message" => $status_message
    );

 return Response::json($response);      
       
    }




}
