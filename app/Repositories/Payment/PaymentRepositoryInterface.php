<?php

namespace App\Repositories\Payment;

use App\Repositories\AbstractRepositoryInterface;

interface PaymentRepositoryInterface extends AbstractRepositoryInterface
{
    public function getArrayPaymentMethod();
    public function activePayment($id);
    public function unactivePayment($id);
}