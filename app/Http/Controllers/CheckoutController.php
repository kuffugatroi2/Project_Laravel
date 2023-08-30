<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout\RegisterCheckoutCustomerRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Services\CheckoutService;
use App\Services\HomeService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected $homeService;
    protected $checkoutService;

    public function __construct(
        HomeService $homeService,
        CheckoutService $checkoutService
    ) {
        $this->homeService = $homeService;
        $this->checkoutService = $checkoutService;
    }

    public function checkout()
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $payments = $this->checkoutService->getPayment();

        return view(
            'checkout.checkout',
            [
                'title' => 'Limupa - Thanh toán'
            ],
            compact('item_type', 'brand_product', 'payments')
        );
    }

    public function saveCheckoutCustomer(RegisterCheckoutCustomerRequest $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $fullName = $request['shipping-first-name'] . ' ' . $request['shipping-last-name'];
        $data = array();
        $data['shipping_name'] = $fullName;
        $data['shipping_email'] = $request['shipping-email'];
        $data['shipping_address'] = $request['shipping-address'];
        $data['shipping_phone'] = $request['shipping-phone'];
        $data['shipping_notes'] = $request['shipping-notes'];
        $data['created_at'] = $today;

        /**
         * Dùng insert để thêm data vào csdl
         * Dùng insertGetId thì lấy luôn được dữ liệu mình vừa insert
         */
        $shipping_id = Shipping::insertGetId($data);

        $request->session()->put('shipping_id', $shipping_id);
        // Session::put('customer_id', $customer_id);

        return Redirect('payment');
    }

    public function orderPlace(RegisterCheckoutCustomerRequest $request)
    {
        $order = $this->checkoutService->orderPlace($request);
        if (isset($order['success']) && $order['success'] == false) {
            return redirect()->back()->with('error', $order['message']);
        }
        if (isset($order['VNPAY']) && $order['VNPAY'] == 'success') {
            return redirect()->back();
        }
        Cart::destroy();
        if ($order['status'] == 200) {
            return redirect()->back()->with('message', $order['message']);
        } else {
            return redirect()->back()->with('error', $order['message']);
        }
    }

    public function vnpayPayment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/successful-payment-confirmation";
        $vnp_TmnCode = "OAGJRI7A"; //Mã website tại VNPAY
        $vnp_HashSecret = "SWPLLTPVQAXGIPZIXFHDXZJNSVGBNHTQ"; //Chuỗi bí mật

        $vnp_TxnRef = 1256; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (float)Cart::total(0, ',', '.') * 100 * 100 * 100 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }

    public function successfulPaymentConfirmation()
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();

        return view(
            'checkout.successful-payment-confirmation',
            [
                'title' => 'Limupa - Thanh toán'
            ],
            compact('item_type', 'brand_product')
        );
    }

    public function saveOrderCheckoutVnpay(RegisterCheckoutCustomerRequest $request)
    {
        $order = $this->checkoutService->saveOrderCheckoutVnpay($request);
        if (isset($order['success']) && $order['success'] == false) {
            return redirect()->back()->with('error', $order['message']);
        }
        Cart::destroy();
        if ($order['status'] == 200) {
            return redirect()->back()->with('message', $order['message']);
        } else {
            return redirect()->back()->with('error', $order['message']);
        }
    }
}
