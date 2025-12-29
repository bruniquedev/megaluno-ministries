<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nyawach\LaravelPesapal\Facades\LaravelPesapal;
use Nyawach\LaravelPesapal\Models\Pesapal;
//https://github.com/Jnyawach/laravel-pesapalv3
use App\Models\donations;
use DateTime;
use Illuminate\Support\Str;
use DB;//import if you want to use sql commands directly
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\content_info;
use App\Models\content_details;

class PesapalController extends Controller
{
    //submit an order request
 public function submitDonation(Request $request){
 $postData = array();
        $postData["language"] = "EN"; //nullable
        $postData["currency"] = "USD"; //This represents the currency you want to charge your customers. ISO formats
        $postData["amount"] = $request->amount;//number_format(1,2); //must be float value and required
        $postData["id"] = $request->id."_".Str::random(6); //Can be your unique order or product id and is required
        $postData["description"] = $request->description; //"Payment for order number AFED67"; //required
        $postData["billing_address"]["phone_number"] = $request->phonenumber;//client phone number required if email unavailable
        $postData["billing_address"]["email_address"] = $request->email; //client email address
        $postData["billing_address"]["country_code"] = "UG";//2 characters long country code in [ISO 3166-1]
        $postData["billing_address"]["first_name"] = $request->Name;
        $postData["billing_address"]["middle_name"] = $request->Name;
        $postData["billing_address"]["last_name"] = $request->Name;
        $postData["billing_address"]["line_1"] = "";//nullable
        $postData["billing_address"]["line_2"] = "";
        $postData["billing_address"]["city"] = "";//nullable
        $postData["billing_address"]["state"] = "";//nullable
        $postData["billing_address"]["postal_code"] = "";//nullable
        $postData["billing_address"]["zip_code"] = "";//nullable
        $postData["callback_url"] = url('/payment-callback/'.config('pesapal.pesapal_guard')); //ensure you guard your callback url
        //$postData["callback_url"] = $request->getScheme()."://".$request->getHost()."/payment-callback/".config('pesapal.pesapal_guard');
        $postData["notification_id"] = config('pesapal.pesapal_ipn_id'); //IPN_id from your .env file
        $postData["terms_and_conditions_id"] = "";
        //return $postData;
        $order=LaravelPesapal::getMerchantOrderURL($postData);
         
         /*
          * Save the transaction details to the database then later update
          * based on transaction status
          * Then render the iframe to present the user with a payment
          * interface
        
       */

        // dd($order->redirect_url);
       
/*
php artisan migrate
*/
       $transaction=new Pesapal();
       $transaction->tracking_id=$order->order_tracking_id;
       $transaction->language=$postData['language'];
       $transaction->currency=$postData['currency'];
       $transaction->amount=$postData['amount'];
       $transaction->merchant_reference=$postData['id'];
       $transaction->description=$postData["description"];
       $transaction->phone_number=$postData["billing_address"]["phone_number"]; 
       $transaction->email=$postData["billing_address"]["email_address"];
       $transaction->country_code=$postData["billing_address"]["country_code"];
       $transaction->first_name=$postData["billing_address"]["first_name"];
       $transaction->middle_name=$postData["billing_address"]["middle_name"];
       $transaction->last_name=$postData["billing_address"]["last_name"];
       $transaction->billing_address_line_1=$postData["billing_address"]["line_1"];
       $transaction->billing_address_line_2=$postData["billing_address"]["line_2"];
       $transaction->city=$postData["billing_address"]["city"];
       $transaction->state=$postData["billing_address"]["state"];
       $transaction->postal_code=$postData["billing_address"]["postal_code"];
       $transaction->zip_code=$postData["billing_address"]["zip_code"];
       
       $transaction->save();


        $data=new donations();
          $data->contentinfo_id = $request->id;
          $data->reference = $order->order_tracking_id;
          $data->amount =  $postData['amount'];
          $data->donationstatus =  0;
          $data->donorname =  $postData["billing_address"]["first_name"]; 
          $data->donoremail =  $postData["billing_address"]["email_address"];
          $data->donorphonenumber = $postData["billing_address"]["phone_number"];   
          $data->addondetails =   $postData["description"]; 
          $data->createddate = date('Y-m-d H:i:s');
          $data->status = 0;
          $data->save();
       
     //You only need to save fields that are important to you
     
    // return $order;
       $title="Complete donation";
           return view('pages.donatecompletion')      
    ->with('Data',$order)
          ->with('title',$title);
       
 }


public function registerIpn(){
    $postData=array();
    //Sample Notification URL guarded by unique string
    // $postData["url"]= request->getScheme()."://".request->getHost().'/pesapal-ipn/'.config('pesapal.pesapal_guard');

    $postData["url"] = url('/pesapal-ipn/'.config('pesapal.pesapal_guard'));
 
    /* IPN Notification type. 
    * This will tell Pesapal how to send the notification. As a POST or GET request
    */
    $postData["ipn_notification_type"]='POST';
 
    return LaravelPesapal::registerIpn($postData);
 
    }


//callback url function

public  function pesapalCallback(Request $request, $pesapalguard){
   $transaction_status=LaravelPesapal::getTransactionStatus($request->OrderTrackingId);
   $donation=donations::where('reference',$request->OrderTrackingId)->firstOrFail();
   /*
    * Based on the transaction status_code you can update the transaction details as
    * failed  or complete. If the transaction is not complete
    * you can redirect the users to attempt the payment again.
    */
    $message="";
    $title="";
    //if the transaction is complete
    
    if ($transaction_status->status_code===1){
    $order=Pesapal::where('tracking_id',$request->OrderTrackingId)->firstOrFail();
     //check if the amounts match
     if ($order->amount==$transaction_status->amount){
      $order->status=$transaction_status->status_code;
      $order->payment_method=$transaction_status->payment_method;
      $order->save();

      
       $donation->donationstatus=1;
       $donation->save();

       $title="Hello, ". $donation->donorname;
       $message="Thank you for your generous donation. May God richly bless you for your kindness and support. Your giving is greatly appreciated and makes a meaningful difference.";
    
      //redirect user to another page. Maybe thank you page
      //return redirect('donate')->with('success','Thank you for your donation.');

     }else{

         $title="Hello, ". $donation->donorname;
       $message="Your donation didn’t go through this time. Please don’t worry—no charges were made. You may try again when ready.";
     // do something else if the amounts do not match
         //return redirect('donate')->with('failure','An error has occurred, please try gain after some time.');
     }
    }else{

       $title="Hello, ". $donation->donorname;
       $message="We’re sorry—your donation was not completed successfully. No funds have been deducted from your account. Please try again.";

     //do something else such redirecting users to attempt the payment again
    }

 $this->NotifyUserEmail($donation->donoremail, $donation->donorname, $donation->addondetails, $message);

   
           return view('pages.donationfinal')      
    ->with('message',$message)
          ->with('title',$title);

}


public function refundPayments(){
        /*
         * confirmation_code:This refers to payment confirmation code that was returned by the processor
         * amount: Amount to be refunded.
         * username: Identity of the user who has initiated the refund.
         * remarks: A brief description on the reason for the refund.
         */
        $postData=array();   
        $postData['confirmation_code']='AA11BB22'; //required
        $postData['amount']='100.00';//required
        $postData['username']='John Doe'; //required
        $postData['remarks']=""; //required
        
       return LaravelPesapal::refundTransaction($postData);
        
  
    }



    public function paymentCallback(Request $request,$pesapalguard){

         $orderTrackingId = $request->query('OrderTrackingId');
        $merchantReference = $request->query('OrderMerchantReference');

       // dd($merchantReference);

    }

public function InstantPaymentNotification(Request $request){
        
    }


public function NotifyUserEmail($recievermail, $reciever, $subject, $message){



$ContactsSetupData = content_info::where('page_area_type', 'contactsetup')->where('detail_type', 'Email')->orderBy('sorted_order', 'asc')->first(); 

$senderemail = "megaluno23@gmail.com";
if($ContactsSetupData->description){
$senderemail = $ContactsSetupData->description;
}

$WebsiteLogoData = content_info::where('page_area_type', 'logo')->orderBy('sorted_order', 'asc')->first(); 
$sender = "";
if($WebsiteLogoData->title){
$sender = $WebsiteLogoData->title;
}

        $Mailobj = new \stdClass();
        $Mailobj->sendermail = $senderemail;
        $Mailobj->sender = $sender;
        $Mailobj->subject = $subject;
        $Mailobj->message = $message;
        $Mailobj->receiveremail = $recievermail;
        $Mailobj->receiver = $reciever;
        
        //Mail::to("receiver@example.com")->send(new DemoEmail($objDemo
        if (Is_internet_connected()){
      $result =  Mail::to($recievermail)->send(new SendEmail($Mailobj));
  }  
    }




}
