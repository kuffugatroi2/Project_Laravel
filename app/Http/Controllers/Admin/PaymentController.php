<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        $payments = $this->paymentService->getAll($request);
        return view(
            'admin.Payment.list-payment',
            [
                'title1' => 'Danh sách phương thức thanh toán | Limupa'
            ],
            compact('payments')
        );
    }


    public function create()
    {
        return view(
            'admin.Payment.create-payment',
            [
                'title1' => 'Danh sách phương thức thanh toán | Limupa'
            ],
        );
    }


    public function store(CreatePaymentRequest $request)
    {
        $payment = $this->paymentService->store($request);
        if ($payment['status'] == 200) {
            return redirect()->route('payments.index')->with('message', $payment['message']);
        } else {
            return redirect()->route('payments.index')->with('error', 'Thêm phương thức thanh toán thất bại!');
        }
    }

    public function edit($id)
    {
        $payment = $this->paymentService->edit($id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return redirect()->route('payments.index')->with('error', $payment['message']);
        }
        if ($payment['status'] == 200) {
            return view('admin.Payment.edit-payment', [
                'title1' => 'Update phương thức thanh toán | Limupa'
            ], compact('payment'));
        } else {
            return redirect()->route('payments.index')->with('error', 'Phương thức thanh toán không tồn tại!');
        }
    }

    public function update(UpdatePaymentRequest $request, $id)
    {
        $payment = $this->paymentService->update($request, $id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return redirect()->route('payments.index')->with('error', $payment['message']);
        }
        if (isset($payment['checkIssetName']) && $payment['checkIssetName'] == true) {
            return redirect()->back()->with('errorName', $payment ['message']);
        }
        if ($payment['status'] == 200) {
            return redirect()->route('payments.index')->with('message', $payment['message']);
        } else {
            return redirect()->route('payments.index')->with('error', $payment['message']);
        }
    }

    public function destroy($id)
    {
        $payment = $this->paymentService->destroy($id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return redirect()->route('payments.index')->with('error', $payment['message']);
        }
        if ($payment) {
            return redirect()->route('payments.index')->with('message', $payment['message']);
        } else {
            return redirect()->route('payments.index')->with('error', $payment['message']);
        }
    }

    public function statusChange($id)
    {
        $payment = $this->paymentService->statusChange($id);
        if (isset($payment['success']) && $payment['success'] == false) {
            return redirect()->route('payments.index')->with('error', $payment['message']);
        }
        switch ($payment['status_after_change']) {
            case Payment::paymentMethodUnactiveStatus:
                return redirect()->route('payments.index')->with('message', 'Tắt Kích hoạt phương thức thanh toán thành công!');
            case Payment::paymentMethodActiveStatus:
                return redirect()->route('payments.index')->with('message', 'Kích hoạt phương thức thanh toán thành công!');
            default:
                return redirect()->route('payments.index');
        }
    }
}
