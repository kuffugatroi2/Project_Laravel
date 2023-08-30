<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function all_coupon() {
        $coupons = Coupon::orderBy('coupon_id', 'DESC')->get();

        return view('admin.Coupon.all_coupon', [
            'title1' => 'Danh mục mã giảm giá',
            'title2' => 'Liệt kê Danh mục mã giảm giá'
        ], compact('coupons'));
    }

    public function add_coupon() {
        return view('admin.Coupon.add_coupon', [
            'title1' => 'Thêm mã giảm giá',
            'title2' => 'Thêm mã giảm giá'
        ]);
    }

    public function save_coupon(Request $request) {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_qty = $data['coupon_qty'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->save();

        $request->session()->flash('message', "Thêm mã giảm giá thành công!");
        return redirect('all-coupon');
    }

    public function delete_coupon($coupon_id) {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        return redirect()->with('massage', 'Xóa mã giảm giá thành công!');
    }
}
