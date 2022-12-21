<?php
namespace App\Helpers;

use App\Helpers\PaymentMethods\Mpesa;

class Billing {
    public function payment_gateway($type) {
        switch ($type) {
            case 'mpesa':
                return new Mpesa();
            default:
                return null;
        };
    }
};