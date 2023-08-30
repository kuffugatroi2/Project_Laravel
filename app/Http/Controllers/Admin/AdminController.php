<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    // public function authLogin() {
    //     // $admin_id = $request->session::get('admin_id');
    //     $admin_id = Session::get('admin_id');
    //     if ($admin_id) {
    //         return Redirect::to('dashboard');
    //     } else {
    //         return Redirect::to('admin')->send();
    //     }
    // }

    public function showDashboard(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m');
        $date = isset($request->month) ? $request->month : $today;
        $month = Carbon::createFromFormat('Y-m', $date)->format('m');
        $year = Carbon::createFromFormat('Y-m', $date)->format('Y');

        $day = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $fromDate = isset($request['from-date']) ? $request['from-date'] : $day;
        $toDate = isset($request['to-date']) ? $request['to-date'] : $day;

        if (isset($request['from-date']) && !is_null($request['from-date']) && is_null($request['to-date'])) {
            // từ from-date -> today
            $fromDate = $fromDate;
            $toDate = $day;
            $toDate = strtotime ( '+1 day' , strtotime ( $toDate ) ) ;
            $toDate = date ( 'Y-m-j' , $toDate );
        } elseif (isset($request['to-date']) && !is_null($request['to-date']) && is_null($request['from-date'])) {
            // Từ start month -> To-date
            $fromDate = Carbon::createFromFormat('Y-m-d', $day)->startOfMonth()->format('Y-m-d');
            $toDate = $toDate;
            $toDate = strtotime ( '+1 day' , strtotime ( $toDate ) ) ;
            $toDate = date ( 'Y-m-j' , $toDate );
        } elseif(
            (isset($request['from-date']) && !is_null($request['from-date']))
            &&
            (isset($request['to-date']) && !is_null($request['to-date']))
        ) {
            // từ from-date -> to-date
            $fromDate = $fromDate;
            $toDate = $toDate;
            $toDate = strtotime ( '+1 day' , strtotime ( $toDate ) ) ;
            $toDate = date ( 'Y-m-j' , $toDate );
        } else {
            // 1 weeks
            $fromDate = strtotime ( '-7 day' , strtotime ( $fromDate ) ) ;
            $fromDate = date ( 'Y-m-j' , $fromDate );
            $toDate = strtotime ( '+1 day' , strtotime ( $toDate ) ) ;
            $toDate = date ( 'Y-m-j' , $toDate );
        }

        $nameAdmin = Auth::user()->name;
        $customers = Customers::count();
        $orders = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
        $totalNumberOfProductsSold = OrderDetails::join('tbl_order', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
                                ->where('tbl_order.order_status', 2)
                                ->whereYear('tbl_order.created_at', $year)
                                ->whereMonth('tbl_order.created_at', $month)
                                ->sum('tbl_order_details.product_sales_quantity');
        $totalRevenue = Order::where('order_status', 2)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->sum('order_total');
        $products = Product::sum('product_quantity');

        $newOrders = $this->getOrderListByDate($fromDate, $toDate);

        return view('admin.dashboard', [
            'title1' => 'Trang chủ',
            'title2' => 'Xin chào '.$nameAdmin.', Chào mừng bạn quay trở lại!'
        ], compact('today', 'customers', 'orders', 'totalNumberOfProductsSold', 'totalRevenue', 'products', 'newOrders'));
    }

    public function getOrderListByDate($fromDate, $toDate)
    {
        $newOrders = Order::join('tbl_customers', 'tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*', 'tbl_customers.customer_name')
        ->where('order_status', 1)
        ->whereBetween('tbl_order.created_at', [$fromDate, $toDate])
        ->orderby('tbl_order.order_id','desc')
        ->paginate(5);
        return $newOrders;
    }
}
