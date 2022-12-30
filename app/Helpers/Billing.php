<?php

namespace App\Helpers;

use App\Helpers\PaymentMethods\Mpesa;
use App\Helpers\PaymentMethods\Paypal;

class Billing
{
    public function payment_gateway($type)
    {
        switch ($type) {
            case 'mpesa':
                return new Mpesa();
            case 'paypal':
                return new Paypal();
            default:
                return null;
        };
    }
};
