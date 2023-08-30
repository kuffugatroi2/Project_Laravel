<?php

namespace App\Services;

use App\Repositories\BrandProduct\BrandProductRepositoryInterface;
use App\Repositories\CategoryProduct\CategoryProductRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAll($request)
    {
        try {
            $payment = $this->paymentRepository->getAll($request);
            return [
                'status' => 200,
                'data' => $payment
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $payment = $this->paymentRepository->store($request, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $payment,
                'message' => 'Thêm phương thức thanh toán thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $payment = $this->paymentRepository->edit($id);
            if (is_null($payment)) {
                return [
                    'success' => false,
                    'error_subcode' => 400,
                    'message' => 'Phương thức thanh toán không tồn tại!'
                ];
            }
            DB::commit();
            return [
                'status' => 200,
                'data' => $payment
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function update($request, $id)
    {
        $resultCheck = false;
        $payment = $this->edit($id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Phương thức thanh toán không tồn tại!'
            ];
        }
        $arrayPaymentMethod = $this->paymentRepository->getArrayPaymentMethod();
        $checkName = in_array($request['payment-method'], $arrayPaymentMethod);
        if ($checkName && $request['payment-method'] != $payment['data']['payment_method']) {
            $resultCheck = true;
            return [
                'status' => 500,
                'checkIssetName' => $resultCheck,
                'message' => 'Phương thức thanh toán này đã tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $payment = $this->paymentRepository->update($request, $id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $payment,
                'message' => 'Update phương thức thanh toán thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Update phương thức thanh toán thất bại!',
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        $payment = $this->edit($id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Phương thức thanh toán không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $payment = $this->paymentRepository->destroy($id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $payment,
                'message' => 'Xóa phương thức thanh toán thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Xóa phương thức thanh toán thất bại!',
                'error' => $e->getMessage()
            ];
        }
    }

    public function activePayment($id)
    {
        $payment = $this->edit($id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Phương thức thanh toán không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $payment = $this->paymentRepository->activePayment($id);
            DB::commit();
            return [
                'status' => 200,
                'data' => $payment,
                'message' => 'Kích hoạt phương thức thanh toán thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Kích hoạt phương thức thanh toán thất bại!',
                'error' => $e->getMessage()
            ];
        }
    }

    public function unactivePayment($id)
    {
        $payment = $this->edit($id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Phương thức thanh toán không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $payment = $this->paymentRepository->unactivePayment($id);
            DB::commit();
            return [
                'status' => 200,
                'data' => $payment,
                'message' => 'Tắt kích hoạt phương thức thanh toán thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Tắt kích hoạt phương thức thanh toán thất bại!',
                'error' => $e->getMessage()
            ];
        }
    }

    public function checkCategory($request)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryProductRepository->checkCategory($request);
            DB::commit();
            return [
                'status' => 200,
                'data' => $category
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getCategory($idBrand)
    {
        $categories = $this->categoryProductRepository->getCategory($idBrand);
        return $categories;
    }
}