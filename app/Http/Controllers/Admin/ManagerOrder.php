<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateStatusOrderRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerOrder extends Controller
{
    public function manager_order(Request $request)
    {
        return view('admin.ManagerOrder.manager-order', [
            'title1' => 'Danh sách đơn hàng',
            'title2' => 'Liệt kê danh sách đơn hàng'
        ], compact('request'));
    }

    public function view_order($order_id)
    {
        $manager_order_by_id = Order::join('tbl_customers', 'tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_payment', 'tbl_order.payment_id','=','tbl_payment.payment_id')
        ->join('tbl_order_details', 'tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_order_details.*', 'tbl_payment.*')
        ->where('tbl_order.order_id', $order_id)
        ->first();

        return view('admin.ManagerOrder.view_order', [
            'title1' => 'Chi tiết đơn hàng',
            'title2' => 'Thông tin người mua',
            'title3' => 'Thông tin vận chuyển',
            'title4' => 'Liệt kê chi tiết đơn hàng'
        ], compact('manager_order_by_id'));
    }

    public function updateStatusOrder(UpdateStatusOrderRequest $request, $order_id)
    {
        $arrayStatus = Order::arrayStatus;
        if (!in_array($request->order_status, $arrayStatus)) {
            return redirect()->back();
        }
        $order = Order::find($order_id);
        if (is_null($order)) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại!');
        }
        DB::beginTransaction();
        try {
            $order->update(['order_status' => $request->order_status]);
            if ($request->order_status == Order::approvedStatus) {
                $orderDetail = OrderDetails::where('order_id', $order_id)->first();
                $product = Product::find($orderDetail->product_id);
                $numberOfProductAfterSale = $product->product_quantity - $orderDetail->product_sales_quantity;
                $product->update(['product_quantity' => $numberOfProductAfterSale]);
                $product->update(['order_status' => $request->order_status]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return redirect()->back()->with('message', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
