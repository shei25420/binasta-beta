<?php
namespace App\Helpers;

class PriceCalculator {
    public static function calculatePackagePrice ($package, $qty) {
        $total_amount = 0;
        foreach ($package->productOptions as $option) {
            $total_amount += $option->wholesale_min * $option->wholesale_price;
        }
        return $total_amount * $qty;
    } 

    public static function calculateUserPrice () {

    }
};