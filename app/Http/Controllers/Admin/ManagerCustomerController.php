<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManagerCustomerController extends Controller
{
    public function getListCustomer(Request $request)
    {
        $customers = Customers::whereNull('deleted_at');
        $keyword = $request['search-name-customer'];
        if (isset($request['search-name-customer']) && !is_null($request['search-name-customer'])) {
            $customers->where('tbl_customers.customer_name','like','%'.$keyword.'%' );
        }
        $customers = $customers->get();
        return view(
            'Admin.ManagerCustomer.list-customer',
            [
                'title1' => 'Danh sách khách hàng | Limupa'
            ],
            compact('customers')
        );
    }

    public function deleteCustomer($idCustomer)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $customers = Customers::whereNull('deleted_at')->findOrFail($idCustomer);
        $customers->deleted_at = $today;
        $customers->save();
        return redirect()->route('customer.get_list_customer')->with('message', 'Xóa khách hàng thành công!');
    }
}
