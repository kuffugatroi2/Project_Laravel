<?php

namespace App\Repositories\Checkout;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function getPayment()
    {
        return Payment::whereNull('deleted_at')->where('payment_status', Payment::paymentMethodActiveStatus)->orderBy('payment_id', 'desc')->get();
    }

    public function orderPlace($request, $today)
    {
        $fullName = $request['shipping-first-name'].' '.$request['shipping-last-name'];
        $data = array();
        $data['shipping_name'] = $fullName;
        $data['shipping_email'] = $request['shipping-email'];
        $data['shipping_address'] = $request['shipping-address'];
        $data['shipping_phone'] = $request['shipping-phone'];
        $data['shipping_notes'] = $request['shipping-notes'];
        $data['created_at'] = $today;
        $shipping_id = Shipping::insertGetId($data);

        // insert order
        $order_data = array();
        $order_data['customer_id'] = Auth::guard('customer')->user()->customer_id;
        $order_data['shipping_id'] = $shipping_id;
        $order_data['payment_id'] =  $request['payment-option'];
        $order_data['tax'] = Cart::tax(0, ',', '.');
        $order_data['order_total'] = Cart::total(0, ',', '.');
        $order_data['order_status'] = Order::approvalPendingStatus;
        $order_data['created_at'] = $today;
        $order_id = Order::insertGetId($order_data);

        // insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] =  $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            $order_d_data['created_at'] = $today;
            OrderDetails::insert($order_d_data);
        }

        return;
    }

    public function saveOrderCheckoutVnpay($request, $today)
    {
        $fullName = $request['shipping-first-name'].' '.$request['shipping-last-name'];
        $data = array();
        $data['shipping_name'] = $fullName;
        $data['shipping_email'] = $request['shipping-email'];
        $data['shipping_address'] = $request['shipping-address'];
        $data['shipping_phone'] = $request['shipping-phone'];
        $data['shipping_notes'] = $request['shipping-notes'];
        $data['created_at'] = $today;
        $shipping_id = Shipping::insertGetId($data);

        // insert order
        $order_data = array();
        $order_data['customer_id'] = Auth::guard('customer')->user()->customer_id;
        $order_data['shipping_id'] = $shipping_id;
        $order_data['payment_id'] = 14;
        $order_data['tax'] = Cart::tax(0, ',', '.');
        $order_data['order_total'] = Cart::total(0, ',', '.');
        $order_data['order_status'] = Order::transportStatus;
        $order_data['created_at'] = $today;
        $order_id = Order::insertGetId($order_data);

        // insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] =  $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            $order_d_data['created_at'] = $today;
            OrderDetails::insert($order_d_data);
        }

        return;
    }
}