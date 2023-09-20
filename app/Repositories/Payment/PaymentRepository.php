<?php

namespace App\Repositories\Payment;

use App\Models\Category;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getAll($request)
    {
        $payments = Payment::whereNull('deleted_at');
        if (
            isset($request['select-status'])
            &&
            in_array($request['select-status'], Payment::arrayStatus)
        ) {
            $payments->where('payment_status', $request['select-status']);
        } elseif (
            isset($request['select-status'])
            &&
            !in_array($request['select-status'], Payment::arrayStatus)
            &&
            strcmp ( $request['select-status'] , Payment::allStatus ) != 0
        ) {
            $payments = [];
            return $payments;
        }
        $keyword = $request['search-name-payment'];
        if (isset($request['search-name-payment']) && !is_null($request['search-name-payment'])) {
            $payments->where('payment_method','like','%'.$keyword.'%' );
        }
        $payments = $payments->get();
        return $payments;
    }

    public function store($request, $today)
    {
        $payment = new Payment();
        $payment->payment_method = $request['payment-method'];
        $payment->payment_desc = $request['payment-description'];
        $payment->payment_status = Payment::paymentMethodActiveStatus;
        $payment->created_at = $today;
        $payment->save();
        return $payment;
    }

    public function edit($id)
    {
        $payment = Payment::whereNull('deleted_at')->find($id);
        return $payment;
    }
    public function update($request, $id, $today)
    {
        $payment = Payment::whereNull('deleted_at')->find($id);
        $payment->payment_method = $request['payment-method'];
        $payment->payment_desc = $request['payment-description'];
        $payment->updated_at = $today;
        $payment->save();
        return $payment;
    }
    public function destroy($id, $today)
    {
        $payment = Payment::whereNull('deleted_at')->findOrFail($id);
        $payment->deleted_at = $today;
        $payment->save();
        return $payment;
    }

    public function statusChange($id, $paymentStatus)
    {
        $paymentStatus = $paymentStatus === Payment::paymentMethodActiveStatus ? Payment::paymentMethodUnactiveStatus : Payment::paymentMethodActiveStatus;
        Payment::where('payment_id', $id)->update(['payment_status' => $paymentStatus]);
        $payment = $this->edit($id);
        return $payment['payment_status'];
    }

    public function getArrayPaymentMethod()
    {
        return Payment::whereNull('deleted_at')->pluck('payment_method')->toArray();
    }
}
