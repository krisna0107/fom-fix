<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Ixudra\Curl\Facades\Curl;

class PaymentGateWay extends Controller
{

    private function baseUrl() {
        return "https://api.sandbox.midtrans.com/v2";
    }

    public function seting(){
        Config::$serverKey = 'U0ItTWlkLXNlcnZlci1sV3JtYzU5ZjkxNEFxOFY1X0gwVUlIcU46';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        // Config::$is3ds = true;
    }

    public function base64yaa($end){
        return base64_encode($end);
    }

    public function getVa($amount, $kdbook, $userid, $bank){

        $data = array(
            "payment_type" => "bank_transfer",
            "transaction_details" => array(
                "gross_amount" => $amount,
                "order_id" => $kdbook
            ),
            "bank_transfer" => array(
                "bank" => $bank,
                "va_number" => $userid
                )
        );
        $response = Curl::to($this->baseUrl().'/charge')
        ->withHeader('Accept: application/json')
        ->withHeader('Authorization: Basic U0ItTWlkLXNlcnZlci1sV3JtYzU5ZjkxNEFxOFY1X0gwVUlIcU46')
        ->withHeader('Content-Type: application/json')
        ->withData( $data )
        ->asJson()
        ->post();
        
        return response()->json($response);
    }

    public function getStatus($kdbook){
        $response = Curl::to($this->baseUrl()."/".$kdbook.'/status')
        ->withHeader('Accept: application/json')
        ->withHeader('Authorization: Basic U0ItTWlkLXNlcnZlci1sV3JtYzU5ZjkxNEFxOFY1X0gwVUlIcU46')
        ->withHeader('Content-Type: application/json')
        ->asJson()
        ->get();
        return response()->json($response);
    }
}
