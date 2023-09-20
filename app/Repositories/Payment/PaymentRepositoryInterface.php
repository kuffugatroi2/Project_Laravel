<?php

namespace App\Repositories\Payment;

use App\Repositories\AbstractRepositoryInterface;

interface PaymentRepositoryInterface extends AbstractRepositoryInterface
{
    public function getArrayPaymentMethod();
    public function statusChange($id, $itemStatus);
}
