<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\messages;
use DB;//import if you want to use sql commands directly
use Response;
use App\Mail\SendContactformEmail;
use Illuminate\Support\Facades\Mail;


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
        //for login references
       // https://www.codecheef.org/article/laravel-8-login-with-custom-guard-example?msclkid=f5d99338a9bf11ec80a1bf67a20f2416
$response = array();      
$message ="";
$status_message ="false";
  $data = new messages();       

$Name = "Anonymous";
$Phone = "Anonymous";

if($request->Name!=""){
$Name = $request->Name;
}
if($request->phonenumber!=""){
$Phone = $request->phonenumber;
}


$data->sendername= $Name;
$data->sendermail= $request->email;  
$data->phonenumber = $Phone;
$data->subject = $request->subject;
$data->messagetext = $request->message;
$data->messagedate= date('Y-m-d H:i:s'); 
$data->seenstatus = 0; 
$data->save();
$message="Thank you for contacting us, we will get back to you as soon as possible.";
$status_message ="true";


$ContactsSetupData =DB::select('select * from contacts where detailtype=:detailtype limit 1',["detailtype"=>"Email"]);
$receiveremail = "bruniquedevelopers@gmail.com";
if(count($ContactsSetupData) > 0){
$receiveremail = $ContactsSetupData[0]->descriptiontext;
}
$WebsiteLogoData =DB::select('select * from logo limit 1');
$receiver = "";
if(count($WebsiteLogoData) > 0){
$receiver = $WebsiteLogoData[0]->text;
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
