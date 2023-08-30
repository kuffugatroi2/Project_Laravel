<?php

namespace App\Repositories\Checkout;

interface CheckoutRepositoryInterface
{
    public function getPayment();
    public function orderPlace($request, $today);
    public function saveOrderCheckoutVnpay($request, $today);
}