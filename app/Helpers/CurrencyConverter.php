<?php
namespace App\Helpers;

class CurrencyConverter {
    public static function convert  ($amount) {
        $curl = curl_init();
        Curl_setopt($curl, CURLOPT_URL, "https://api.apilayer.com/fixer/convert?to=USD&from=KES&amount=".$amount);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["apikey: ".config('app.fixer_api_key')]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $result = curl_exec($curl);
        return json_decode($result);
    }
}