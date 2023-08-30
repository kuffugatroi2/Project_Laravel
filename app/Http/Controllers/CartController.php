<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Services\HomeService;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Illuminate\Contracts\Session\Session;
// use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function saveCart(Request $request)
    {
        $productId = $request->product_id_hidden;
        $quantity = $request->qty;
        $product_info = Product::where('product_id', $productId)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);

        $data['id'] = $product_info->product_id; //dùng cái productId
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10); //cho thuế toàn bộ sản phẩm bằng 10%
        // Cart::destroy();

        return redirect()->route('cart.show_cart');
    }

    public function showCart() {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        return view(
            'pages.cart.show_cart',
            [
                'title' => 'Limupa - Giỏ hàng'
            ],
            compact('item_type', 'brand_product')
        );
    }

    public function updateCartQuantity(Request $request) {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        cart::update($rowId, $qty);
        return redirect()->back();
    }

    public function deleteToCart($rowId) {
        /*
            chỉ cần update rowId về 0 là xóa được
            số lượng = 0 tức là không tồn tại
            thì sẽ được xóa khỏi giỏ hàng
        */
        Cart::update($rowId, 0);
        return redirect()->back();
    }

    public function show_cart_ajax() {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        return view('pages.cart.show_cart_ajax',
        compact('item_type', 'brand_product')
        );
    }

    public function add_cart_ajax(Request $request) {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0,26),5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach($cart as $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
            Session::put('cart', $cart);
        }
        Session::save();
        // print_r($data);
    }

    public function update_cart_ajax(Request $request) {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach($data['cart_quantity'] as $key => $qty) {
                foreach($cart as $session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công!');
        } else {
            return redirect()->back()->with('message', 'Cập nhật số lượng thất bại!');
        }
    }

    public function delete_to_cart_ajax($session_id) {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart); // put lại cart sau khi xóa
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công!');
        } else {
            return redirect()->back()->with('message', 'Xóa sản phẩm thất bại!');
        }
    }

    public function delete_all_cart_ajax() {
        $cart = Session::get('cart');
        if ($cart == true) {
            // Session::destroy(); // xóa tất cả các session (các session đăng nhập, giỏ hàng, mã giảm giá...)
            Session::forget('cart'); // Chỉ xóa session cart
            Session::forget('coupon'); // Chỉ xóa session coupon
            return redirect()->back()->with('message', 'Xóa hết giỏ hàng thành công!');
        } else {
            return redirect()->back()->with('message', 'Xóa hết giỏ hàng thất bại!');
        }
    }

    public function check_coupon(Request $request) {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Thêm mã giám giá thành công!');
            }
        } else {
            return redirect()->back()->with('error', 'Mã giảm giá không đúng!');
        }
    }

    public function del_coupon() {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            // Session::destroy(); // xóa tất cả các session (các session đăng nhập, giỏ hàng, mã giảm giá...)
            Session::forget('coupon'); // Chỉ xóa session coupon
            return redirect()->back()->with('message', 'Xóa mã giảm giá thành công!');
        } else {
            return redirect()->back()->with('message', 'Xóa mã giảm giá thất bại!');
        }
    }

}
