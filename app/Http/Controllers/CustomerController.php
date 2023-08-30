<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\LoginCustomerRequest;
use App\Http\Requests\Customer\RegisterCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customers;
use App\Services\CustomerService;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $homeService;
    protected $customerService;

    public function __construct(
        HomeService $homeService,
        CustomerService $customerService
        )
    {
        $this->homeService = $homeService;
        $this->customerService = $customerService;
    }

    public function loginCheckout()
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        return view(
            'checkout.login_checkout',
            [
                'title' => 'Limupa - Đăng nhập'
            ],
            compact('item_type', 'brand_product')
        );
    }

    public function register()
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        return view(
            'checkout.register',
            [
                'title' => 'Limupa - Đăng ký tài khoản'
            ],
            compact('item_type', 'brand_product')
        );
    }

    public function addCustomer(RegisterCustomerRequest $request)
    {
        $customer = $this->customerService->register($request);
        if ($customer['status'] == 200) {
            return Redirect()->route('customer.login_checkout')->with('message', $customer['message']);
        } else {
            return Redirect()->route('customer.login_checkout')->with('error', 'Đăng ký tài khoản thất bại!');
        }
    }

    public function loginCustomer(LoginCustomerRequest $request)
    {
        $login = $this->customerService->loginCustomer($request);
        if ($login['resultLogin'] == true) {
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('error', $login['message']);
        }
    }

    public function logoutCustomer(Request $request)
    {
        // $request->session()->flush(); // flush: xóa hết session data
        // return Redirect('login-checkout');

        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login_checkout');
    }

    public function profileCustomer($customer_id)
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $profile = $this->customerService->getProfileCustomer($customer_id);
        return view(
            'pages.Customer.profile-customer',
            [
                'title' => 'Limupa - Thông tin cá nhân'
            ],
            compact('item_type', 'brand_product', 'profile')
        );
    }

    public function updateProfileCustomer(UpdateCustomerRequest $request, $customer_id) {
        $profile = $this->customerService->updateProfileCustomer($request, $customer_id);
        if ($profile) {
            return redirect()->back()->with('message', $profile['message']);
        } else {
            return redirect()->back()->with('error', $profile['message']);
        }
    }
}
