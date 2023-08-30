<?php

namespace App\Services;

use App\Repositories\Customer\CustomerRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function register($request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $input = $request->except(['customer-password-again']);
        $data = array();
        $data['customer_name'] = $input['customer-name'];
        $data['customer_email'] = $input['customer-email'];
        $data['password'] = bcrypt($input['customer-password']);
        $data['customer_phone'] = $input['customer-phone'];
        $data['created_at'] = $today;
        DB::beginTransaction();
        try {
            $customer = $this->customerRepository->register($data);
            DB::commit();
            return [
                'status' => 200,
                'data' => $customer,
                'message' => 'Đăng ký tài khoản thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function loginCustomer($request)
    {
        $resultLogin = false;
        $data = [
            'customer_email' => $request['customer-email'],
            'password' => $request['customer-password'],
        ];
        if (Auth::guard('customer')->attempt($data)) {
            $resultLogin = true;
            return [
                'resultLogin' => $resultLogin,
                'status' => 200,
                'message' => 'Đăng nhập thành công!'
            ];
        } else {
            return [
                'resultLogin' => $resultLogin,
                'status' => 401,
                'message' => 'Đăng nhập không thành công! email hoặc mật khẩu không chính xác'
            ];
        }
    }

    public function getProfileCustomer($customer_id)
    {
        DB::beginTransaction();
        try {

            $profile = $this->customerRepository->getProfileCustomer($customer_id);
            DB::commit();
            return [
                'status' => 200,
                'data' => $profile,
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function updateProfileCustomer($request, $customer_id)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        DB::beginTransaction();
        try {
            $profile = $this->customerRepository->updateProfileCustomer($request ,$customer_id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $profile,
                'message' => 'Cập nhật thông tin thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Cập nhật thông tin thất bại!',
                'error' => $e->getMessage()
            ];
        }
    }
}