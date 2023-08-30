<?php

namespace App\Repositories\Customer;

interface CustomerRepositoryInterface
{
    public function register($data);
    public function getProfileCustomer($customer_id);
    public function updateProfileCustomer($request ,$customer_id, $today);
}