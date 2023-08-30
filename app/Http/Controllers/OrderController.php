<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shipping\UpdateShippingRequest;
use App\Models\Order;
use App\Models\Shipping;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function managerOrder($customer_id)
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $orders = Order::join('tbl_order_details', 'tbl_order.order_id','=','tbl_order_details.order_id')
        ->where('tbl_order.customer_id', $customer_id)
        ->orderby('tbl_order.order_id','desc')->get();
        return view(
            'pages.Order.manager-order',
            [
                'title' => 'Limupa - Giỏ hàng'
            ],
            compact('item_type', 'brand_product', 'orders')
        );
    }

    public function viewOrder($order_id)
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();

        $customer = Order::join('tbl_customers', 'tbl_order.customer_id','=','tbl_customers.customer_id')
                ->where('tbl_order.order_id', $order_id)->first();

        $detailOrders = Order::join('tbl_shipping', 'tbl_order.shipping_id','=','tbl_shipping.shipping_id')
                ->join('tbl_order_details', 'tbl_order.order_id','=','tbl_order_details.order_id')
                ->join('tbl_payment', 'tbl_order.payment_id','=','tbl_payment.payment_id')
                ->where('tbl_order.order_id', $order_id)->first();

        if (Auth::guard('customer')->check()) {
            if ($customer['customer_id'] !== Auth::guard('customer')->id()) {
                return redirect()->back();
            }
            return view(
                'pages.Order.view-order',
                [
                    'title' => 'Limupa - Giỏ hàng'
                ],
                compact('item_type', 'brand_product', 'detailOrders')
            );
        } else {
            return redirect()->back();
        }
    }

    public function cancelOrder($order_id)
    {
        $orders = Order::where('order_id', $order_id)->update(['order_status' => Order::rejectionStatus]);
        if ($orders) {
            return redirect()->back()->with('message', 'Hủy đợn hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'Hủy đợn hàng thất bại!');
        }
    }

    public function buyBackOrder($order_id)
    {
        $orders = Order::where('order_id', $order_id)->update(['order_status' => Order::approvalPendingStatus]);
        if ($orders) {
            return redirect()->back()->with('message', 'Mua lại đơn hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'Mua lại đơn hàng thất bại!');
        }
    }

    public function updateShipping(UpdateShippingRequest $request, $shipping_id)
    {
        $data = $request->except('_token');
        $shipping = Shipping::where('shipping_id', $shipping_id)->update([
            "shipping_name" => $data['shipping-name'],
            "shipping_email" => $data['shipping-email'],
            "shipping_phone" => $data['shipping-phone'],
            "shipping_address" => $data['shipping-address'],
            "shipping_notes" => $data['shipping-notes']
        ]);
        if ($shipping) {
            return redirect()->back()->with('message', 'cập nhật thông tin giao hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'cập nhật thông tin giao hàng thất bại!');
        }
    }
}
