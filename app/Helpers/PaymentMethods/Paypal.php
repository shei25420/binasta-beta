<?php
namespace App\Helpers\PaymentMethods;

class Paypal {
    private $base_url;
    private $client_id;
    private $client_secret;

    public function __construct() {
        $this->base_url = config("app.paypal_base_url");
        $this->client_id = config("app.paypal_client_id");
        $this->client_secret = config("app.paypal_client_secret");
    }

    private function authorize () {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->base_url."/v1/oauth2/token");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($curl, CURLOPT_USERPWD, $this->client_id.":".$this->client_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/x-www-form-urlencoded"]);

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function process_payment($data, $distributor = false) {
        $purchase_units = [];
        $total_amount = 0;

        if($distributor) {
            foreach ($data["order"]->distributor_packages as $package) {
                $total_amount = 0;
                foreach ($package->productOptions as $option) {
                    $total_amount += $option->wholesale_min * $option->wholesale_price;
                }
                $amount = ["amount" => [
                    "currency_code" => "USD",
                    "description" => $package->name,
                    "unit_amount" => $total_amount,
                    "item_total" => $total_amount * $package->quantity,
                    "value" => $total_amount * $package->quantity
                ]];

                if($package->discounts && count($package->discounts)) {
                    $discount_amount = ($package->discounts[0]->percentage / 100) * $option->wholesale_price;
                    $amount["discount"] = ["value" => $discount_amount];
                    $amount["item_total"] -= $discount_amount * $package->quantity;
                    $amount["value"] -= $discount_amount * $option->selling_price;
                }
                array_push($purchase_units, $amount);
            }
        } else {
            foreach ($data["order"]->product_options as $option) {
                $unit_amount = $option->selling_price;
                $amount = ["amount" => [
                    "currency_code" => "USD",
                    "description" => $option->product->name." ".$option->variation."(x".$option->wholesale_min.")",
                    "unit_amount" => $unit_amount,
                    "item_total" => $unit_amount * $option->pivot->quantity,
                    "value" => $unit_amount * $option->pivot->quantity
                ]];

                if($option->product->discounts && count($option->product->discounts)) {
                    $discount_amount = ($option->product->discounts[0]->percentage / 100) * $option->selling_price;
                    $amount["discount"] = ["value" => $discount_amount];
                    $amount["item_total"] -= $discount_amount * $option->pivot->quantity;
                    $amount["value"] -= $discount_amount * $option->selling_price;
                }

                array_push($purchase_units, $amount);
                $total_amount += $unit_amount * $option->pivot->quantity;
            }
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->base_url."/v2/checkout/orders");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type:application/json", "Authorization: Bearer ".$this->authorize()->access_token]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(["intent" => "CAPTURE", "purchase_units" => $purchase_units]));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
