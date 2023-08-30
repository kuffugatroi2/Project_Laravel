<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Wards;
use App\Models\Feeshipping;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function all_delivery() {
        $delivery = Feeshipping::orderBy('fee_id', 'DESC')->get();

        return view('admin.Delivery.all_delivery', [
            'title1' => 'Danh mục vận chuyển',
            'title2' => 'Liệt kê vận chuyển'
        ], compact('delivery'));
    }

    public function delivery(Request $request) {
        $cities = City::orderby('matp', 'ASC')->get();
        $districts = District::orderby('maqh', 'ASC')->get();
        $wards = Wards::orderby('xaid', 'ASC')->get();

        return view('admin.Delivery.add_delivery', [
            'title1' => 'Thêm vận chuyển',
            'title2' => 'Thêm vận chuyển'
        ], compact('cities', 'districts', 'wards'));

        // $cities = City::orderby('matp', 'ASC')->get();

        // return view('admin.Delivery.add_delivery', [
        //     'title1' => 'Thêm vận chuyển',
        //     'title2' => 'Thêm vận chuyển'
        // ], compact('cities'));

    }

    public function add_delivery(Request $request) {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_districts = District::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output.= '<option>---- Chọn quận / huyện----</option>';
                foreach($select_districts as $districts) {
                    $output.='<option value="'.$districts->maqh.'">'.$districts->name.'</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output.= '<option>---- Chọn xã / phường----</option>';
                foreach($select_wards as $wards) {
                    $output.='<option value="'.$wards->xaid.'">'.$wards->name.'</option>';
                }
            }
        }
        echo $output;
    }

    public function save_delivery(Request $request) {
        $data = $request->all();
        $fee_ship = new Feeshipping();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['district'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
        // print_r($data);
    }

    public function update_delivery(Request $request) {
        $data = $request->all();
        $fee_ship = Feeshipping::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}
