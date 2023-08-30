<?php

namespace App\Repositories\Customer;

use App\Models\Category;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function register($data)
    {
        // /**
        //  * Dùng insert để thêm data vào csdl
        //  * Dùng insertGetId thì lấy luôn được dữ liệu mình vừa insert
        //  */
        return Customers::insertGetId($data);
    }

    public function getProfileCustomer($customer_id)
    {
        return Customers::find($customer_id);
    }

    public function updateProfileCustomer($request ,$customer_id, $today)
    {
        $birthday = $request['date-of-birth'] . '-' . $request['month-of-birth'] . '-' . $request['year-of-birth'];
        $customer = Customers::find($customer_id);
        $customer['customer_name'] = $request['customer_name'];
        $customer['customer_phone'] = $request['customer_phone'];
        $customer['customer_address'] = $request['customer_address'];
        $customer['gender'] = $request['gender'];
        $customer['birthday'] = $birthday;
        $customer['updated_at'] = $today;
        if (isset($request['password'])) {
            $customer['password'] = bcrypt($request['password']);
        }
        $customer->save();
        return;
    }
}