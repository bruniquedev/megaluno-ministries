<?php

namespace App\Http\Controllers\PagesControllers;
//use Pesapal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesapalPayment;
use App\Models\PesapalPaymentIpn;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Mhassan654\Pesapal\Exceptions\PesapalException;
use Mhassan654\Pesapal\Pesapal;
use Random\RandomException;

class PesapalPaymentController extends Controller
{
     /**
     * @var Pesapal
     */
    protected Pesapal $pesapal;

    /**
     * @param Pesapal $pesapal
     * @return void
     */
    public function  __construct(Pesapal $pesapal)
    {
        $this->pesapal = $pesapal;
    }

    /**
     * @return JsonResponse
     * @throws PesapalException
     * @throws RandomException
     */
    public function payment(Request $request)
    {//initiates payment

        $transaction_id =  (new Pesapal)->random_reference();
        $payments = new PesapalPayment;
        $payments->merchant_reference =$transaction_id;
        $payments->status = 'NEW';
        $payments->amount = $request->amount;
        $payments->save();


        $billing_object = (object)[
            "email_address" => $request->billing_address['email_address'],
            "phone_number" => $request->billing_address['phone_number'],
            "country_code" => $request->billing_address['country_code'],
            "first_name" => $request->billing_address['first_name'],
            "middle_name" => $request->billing_address['middle_name'],
            "last_name" => $request->billing_address['last_name'],
            "line_1" =>  $request->billing_address['line_1'],
            "line_2" =>  $request->billing_address['line_2'],
            "city" => $request->billing_address['city'],
            "state" => $request->billing_address['state'],
            "postal_code" => null,
            "zip_code" => null
        ];


        $payment_request = [ // the defaults will be overidden if set in $params
            'id' => $transaction_id,
            'amount' => $request->amount,
            'currency'=>'UGX',
            'description' => $request->description,
            'callback_url' => $request->callback_url,
            "notification_id" => $request->notification_id,
            "branch"=> "Project Code - Kampala",
            'billing_address' => $billing_object
        ];

        $pesapal_payment= (new Pesapal)->makePayment($payment_request);
        $decode_response = json_decode($pesapal_payment);

        // check for parameter errors
        if ($decode_response->error && $decode_response->error->code == 'invalid_api_request_parameters') {
            return $this->customFailResponseWithPayload($decode_response->error->message);
        }

        if ($decode_response->status == "200"){
            $payments = PesapalPayment::where('merchant_reference',$decode_response->merchant_reference)->first();
            $payments->order_tracking_id = $decode_response->order_tracking_id;
            $payments->status = 'PENDING';
            $payments->update();
        }
        return $this->customSuccessResponseWithPayload($decode_response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function paymentsuccess(Request $request)//just tells u payment has gone thru..but not confirmed
    {
        $trackingid = $request->input('order_tracking_id');
        $ref = $request->input('merchant_reference');

        $payments = PesapalPayment::where('merchant_reference',$ref)->first();
        $payments->trackingid = $trackingid;
        $payments->status = 'PENDING';
        $payments->save();


        $payments=PesapalPayment::all();
        return $this->customSuccessResponseWithPayload($payments);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function paymentConfirmation(Request $request)
    {
        $trackingid = $request->input('OrderTrackingId');
        $merchant_reference = $request->input('OrderMerchantReference');
        $pesapal_notification_type= $request->input('OrderNotificationType');

        //use the above to retrieve payment status now..
        $this->checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type);
    }

    //Confirm status of transaction and update the DB

    /**
     * @param $trackingid
     * @param $merchant_reference
     * @param $pesapal_notification_type
     * @return string
     * @throws PesapalException
     */
    public function checkpaymentstatus($trackingid, $merchant_reference, $pesapal_notification_type){

        $status_response=$this->pesapal->getTransactionStatus($trackingid);
        $status = json_decode($status_response);

        if ($status->status == "200"){
            $payments = PesapalPayment::where('order_tracking_id',$trackingid)->first();
            $payments->status = $status->status;

//            Pesapal status code representing the payment_status_description.
//            0 - INVALID
//            1 - COMPLETED
//            2 - FAILED
//            3 - REVERSED
            $payments->status_code = $status->status_code;
            $payments->payment_method = $status->payment_method;
            $payments->description = $status->description;
            $payments->created_date = $status->created_date;
            $payments->message = $status->message;
            $payments->payment_account = $status->payment_account;
            $payments->merchant_reference = $status->merchant_reference;
            $payments->currency = $status->currency;
            $payments->amount = $status->amount;
            $payments-> update();
            return $this->customSuccessResponseWithPayload("success");
        }
        return $this->customFailResponseWithPayload("something went wrong");
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function registerIPN(Request $request)
    {
        try {
            $url = $request->url;
            $notification_type = $request->ipn_notification_type;

            $ipn_data = $this->pesapal->registerIPN($url, $notification_type);

           $resp = json_decode($ipn_data);

            $new_ipn = new PesapalPaymentIpn;
            $new_ipn->url = $resp->url;
            $new_ipn->created_date = $resp->created_date;
            $new_ipn->ipn_id = $resp->ipn_id;

            if ( $new_ipn->save()){
                return response()->json($new_ipn);
            }

            return \response()->json("something went wrong");
        }catch (\Exception $exception){
            return \response()->json($exception->getMessage());
        }
    }

    /**
     * @return
     */
    public function getRegisteredIPN()
    {
        $respo_data = $this->pesapal->getRegisterIPNlist();
        $decode_data = json_decode($respo_data);
        return \response()->json($decode_data);
    }

    public function ipnReceiver($OrderTrackingId, $status, $payment_method, $OrderMerchantReference)
    {
        $payments = PesapalPayment::where('order_tracking_id',$OrderTrackingId)->first();
        if ($payments){
            $payments->status = $status;
            $payments->payment_method = $payment_method;
            $payments->update();
        }

    }
}
