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

        return view('admin.dashboard', [
            'title1' => 'Trang chủ',
            'title2' => 'Xin chào ' . $nameAdmin . ', Chào mừng bạn quay trở lại!'
        ], compact('today', 'customers', 'orders', 'totalNumberOfProductsSold', 'totalRevenue', 'products'));
    }
}
