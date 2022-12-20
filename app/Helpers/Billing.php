<?php
namespace App\Helpers;

use App\Helpers\PaymentMethods\Mpesa;

class Billing {
    public function process_payment($type) {
        switch ($type) {
            case 'mpesa':
                return new Mpesa();
            default:
                return null;
        };
    }
};