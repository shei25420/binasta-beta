<?php
namespace App\Helpers\PaymentMethods;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Mpesa {
    private $_base_url = "https://sandbox.safaricom.co.ke";
    private $_business_code;
    private $_pass_key;
    private $_key;
    private $_secret;
    private $_callback_url;

    public function __construct()
    {
        $this->_business_code = config('app.mpesa_business_short_code');
        $this->_pass_key = config('app.mpesa_pass_key');
        $this->_key = config('app.mpesa_consumer_key');
        $this->_secret = config('app.mpesa_consumer_secret');
        $this->_callback_url = config('app.mpesa_callback_url');
    }
    
    private function access_token() {
        $oauth_path = $this->_base_url.'/oauth/v1/generate?grant_type=client_credentials';
        $credentials = base64_encode($this->_key.":".$this->_secret);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $oauth_path);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        return $response->access_token;
    }
    
    private function encrpt_security_cred ($credentials) {
        $security_credentials = "";
        openssl_public_encrypt(config('app.mpesa_intitator_password'), $security_credentials, Storage::disk('local')->get('certificates/SandboxCertificate.cer'));

        return $security_credentials;
    }

    private function mpesa_express ($data) {
        $stk_path = $this->_base_url.'/mpesa/stkpush/v1/processrequest';
        $time_stamp = Carbon::rawParse('now')->setTimezone('EAT')->format('YmdHis');
        $data = [
            'BusinessShortCode' => $this->_business_code, 
            'Password' => base64_encode($this->_business_code.$this->_pass_key.$time_stamp), 
            'Timestamp' => $time_stamp, 
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => 1,
            'PartyA' => '254'.$data['phone'],
            'PartyB' => $this->_business_code,
            'PhoneNumber' => '254'.$data['phone'],
            'CallBackURL' => $this->_callback_url.'/api/payments/m_wallet/confirm/0',
            'AccountReference' => 'TransRef12',
            'TransactionDesc' => 'Payment for products bought from binasta limited'
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $stk_path);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer '.$this->access_token()]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        return $response;
    }

    private function register_url () {
        $registration_path = $this->_base_url.'/mpesa/c2b/v1/registerurl';
        $data = [
            'ValidationURL' => $this->_callback_url.'/api/url_validation',
            'ConfirmationURL' => $this->_callback_url.'/api/url_confirmation',
            'ResponseType' => 'Canceled',
            'ShortCode' => $this->_business_code
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $registration_path);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer '.$this->access_token()]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        
        dd($response);
    }

    private function c2b () {
        $c2b_path = $this->_base_url.'/mpesa/c2b/v1/simulate';
        $data = [
            'CommandID' => 'CustomerPayBillOnline',
            'Amount' => 1,
            'Msisdn' => '254724162635',
            'BillRefNumber' => 'TestRef1',
            'ShortCode' => $this->_business_code
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $c2b_path);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer '.$this->access_token()]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        dd($response);
    }

    private function b2c () { 
        $security_credentials = $this->encrpt_security_cred(config('app.mpesa_intitator_password'));

        $b2c_path = $this->_base_url.'/mpesa/b2c/v1/paymentrequest';
        $data = [    
            "InitiatorName" => "testapi",
            'SecurityCredential' => base64_encode($security_credentials),
            'CommandID' => 'SalaryPayment',
            'Amount' => 1,
            'PartyA' => '600992',
            'PartyB' => '254708374149',
            'Remarks' => 'Payment from Binasta Limited',
            'QueueTimeOutURL' => $this->_callback_url.'/api/b2c/timeout',
            'ResultURL' => $this->_callback_url.'/api/b2c/result',
            'Occassion' => 'Payment for week income'
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $b2c_path);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer '.$this->access_token()]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        dd($response);
    }

    private function account_balance () {
        $url_path = $this->_base_url.'/mpesa/accountbalance/v1/query';
        $data = [
            
        ];
    }

    private function reversal () {
        $url_path = $this->_base_url."/mpesa/reversal/v1/request";
        $security_credentials = base64_encode($this->encrpt_security_cred(config('app.mpesa_intitator_password')));
        $data = [
            "Initiator" => "testapi",
            "ReceiverParty" => "600986",
            "ReceiverIdentifierType" => "4",
            "TransactionID" => "OEI2AK4Q16",
            "Amount" => 1,
            "Remarks" => "Reversal for transaction blah blah blah",
            "CommandID" => "TransactionReversal",
            "SecurityCredential" => $security_credentials,    
            "QueueTimeOutURL" => $this->_callback_url.'/api/reversal/timout',
            "ResultURL" => $this->_callback_url.'/api/reversal/result'
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url_path);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer '.$this->access_token()]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        dd($response);
    }

    public function process_payment($data) {
        return $this->mpesa_express($data);
    }
    
    public function confirm_payment($data) {

    }
    
    public function query_payment($data) {
        
    }  
};