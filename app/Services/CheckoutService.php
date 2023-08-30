<?php

namespace App\Services;

use App\Models\Payment;
use App\Repositories\Checkout\CheckoutRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutService
{
    protected $checkoutRepository;

    public function __construct(CheckoutRepositoryInterface $checkoutRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
    }

    public function getPayment()
    {
        DB::beginTransaction();
        try {

            $payments = $this->checkoutRepository->getPayment();
            DB::commit();
            return [
                'status' => 200,
                'data' => $payments,
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function orderPlace($request)
    {
        $totalCart = Cart::total(0, ',', '.');
        if ($totalCart == 0) {
            return [
                'success' => false,
                'error_subcode' => 500,
                'message' => 'Giỏ hàng của bạn đang trống!
                Bạn vui lòng chọn cho mình một món hàng ưng ý vào giỏ hàng để tiếp tục thanh toán.'
            ];
        }
        if (isset($request['payment-option'])) {
            $payment = Payment::whereNull('deleted_at')->find($request['payment-option']);
            if (strcmp($payment['payment_method'], 'VNPAY') === 0) {
                return [
                    'VNPAY' => 'success'
                ];
            }
        }
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        DB::beginTransaction();
        try {
            $order = $this->checkoutRepository->orderPlace($request, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $order,
                'message' => 'Đặt hàng thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Đặt hàng thất bại!',
                'error' => $e->getMessage()
            ];
        }

    }

    public function saveOrderCheckoutVnpay($request)
    {
        $totalCart = Cart::total(0, ',', '.');
        if ($totalCart == 0) {
            return [
                'success' => false,
                'error_subcode' => 500,
                'message' => 'Giỏ hàng của bạn đang trống!
                Bạn vui lòng chọn cho mình một món hàng ưng ý vào giỏ hàng để tiếp tục thanh toán.'
            ];
        }

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        DB::beginTransaction();
        try {
            $order = $this->checkoutRepository->saveOrderCheckoutVnpay($request, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $order,
                'message' => 'Đặt hàng thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Đặt hàng thất bại!',
                'error' => $e->getMessage()
            ];
        }

    }
}