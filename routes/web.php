<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandProductController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\ManagerCustomerController;
use App\Http\Controllers\Admin\ManagerOrder;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TypeItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginFacebook;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//FONTEND
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('search', [HomeController::class, 'search'])->name('search');

// show sản phẩm
Route::get('show-products-by-item/{item_id}', [HomeController::class, 'show_products_by_item']);
Route::get('show-products-by-brand/{brand_id}', [HomeController::class, 'show_products_by_brand']);
Route::get('show-products-by-category/{category_id}', [HomeController::class, 'show_products_by_category']);
Route::get('show-product', [HomeController::class, 'show_product']);
Route::get('details-product/{product_id}', [HomeController::class, 'details_product']);

// Cart
Route::post('save-cart', [CartController::class, 'saveCart'])->name('cart.save_cart');
Route::get('show-cart', [CartController::class, 'showCart'])->name('cart.show_cart');
Route::post('update-cart-quantity', [CartController::class, 'updateCartQuantity'])->name('cart.update_cart_quantity');
Route::get('delete-to-cart/{rowId}', [CartController::class, 'deleteToCart'])->name('cart.delete_to_cart');

// Cart Ajax
Route::post('add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('show-cart-ajax', [CartController::class, 'show_cart_ajax']);
Route::post('update-cart-ajax', [CartController::class, 'update_cart_ajax']);
Route::get('delete-to-cart-ajax/{session_id}', [CartController::class, 'delete_to_cart_ajax']);
Route::get('delete-all-cart-ajax', [CartController::class, 'delete_all_cart_ajax']);

// Coupon
Route::post('check-coupon', [CartController::class, 'check_coupon']);
Route::get('del-coupon', [CartController::class, 'del_coupon']);

// Customer
Route::get('login-checkout', [CustomerController::class, 'loginCheckout'])->name('customer.login_checkout');
Route::get('register', [CustomerController::class, 'register'])->name('customer.register');
Route::post('add-customer', [CustomerController::class, 'addCustomer'])->name('customer.add_customer');
Route::post('login-customer', [CustomerController::class, 'loginCustomer'])->name('customer.login_customer');
Route::get('logout-customer', [CustomerController::class, 'logoutCustomer'])->name('customer.logout_customer');
Route::get('profile-customer/{customer_id}', [CustomerController::class, 'profileCustomer'])->name('customer.profile_customer');
Route::post('update-profile-customer/{customer_id}', [CustomerController::class, 'updateProfileCustomer'])->name('customer.update_profile_customer');

// Checkout
Route::get('checkout', [CheckoutController::class, 'checkout']);
Route::post('save-checkout-customer', [CheckoutController::class, 'saveCheckoutCustomer'])->name('checkout.save-checkout-customer');
Route::get('payment', [CheckoutController::class, 'payment']);
Route::post('order-place', [CheckoutController::class, 'orderPlace'])->name('checkout.order_place');

Route::post('vnpay_payment', [CheckoutController::class, 'vnpayPayment']);
Route::get('successful-payment-confirmation', [CheckoutController::class, 'successfulPaymentConfirmation'])->name('checkout.successful_payment_confirmation');
Route::post('save-order-checkout-vnpay', [CheckoutController::class, 'saveOrderCheckoutVnpay'])->name('checkout.save_order_checkout_vnpay');
// manager order
Route::get('manager-order/{customer_id}', [OrderController::class, 'managerOrder'])->name('manager_order');
Route::get('view-order/{order_id}', [OrderController::class, 'viewOrder'])->name('view_order');
Route::get('cancel-order/{order_id}', [OrderController::class, 'cancelOrder'])->name('cancel_order');
Route::get('buy-back-order/{order_id}', [OrderController::class, 'buyBackOrder'])->name('buy_back_order');
Route::post('update-shipping/{shipping_id}', [OrderController::class, 'updateShipping'])->name('update_shipping');

/*---------------------------------------------------BACKEND---------------------------------------------------------------*/

//Login
Route::get('admin/login', [UserController::class, 'index'])->name('login');
Route::post('admin', [UserController::class, 'postLogin'])->name('PostLogin');
Route::get('admin-logout', [UserController::class, 'adminLogout'])->name('admin.logout');

/*---------------------------------------------------ADMIN---------------------------------------------------------------*/

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');
        Route::get('get-order-list-by-date', [AdminController::class, 'getOrderListByDate'])->name('dashboard.get_order_list_by_date');

        //Item type product
        Route::resource('items', TypeItemController::class);
        Route::get('status-change-item/{id}', [TypeItemController::class, 'statusChange'])->name('items.status_change');

        //Brand product
        Route::resource('brands', BrandProductController::class);
        Route::get('status-change-brand/{id}', [BrandProductController::class, 'statusChange'])->name('brands.status_change');

        //Categories
        Route::resource('categories', CategoryProductController::class);
        Route::get('active-category/{id}', [CategoryProductController::class, 'activeCategory'])->name('categories.active_category');
        Route::get('unactive-category/{id}', [CategoryProductController::class, 'unactiveCategory'])->name('categories.unactive_category');

        //Payment
        Route::resource('payments', PaymentController::class);
        Route::get('active-payment/{id}', [PaymentController::class, 'activePayment'])->name('payments.active_payment');
        Route::get('unactive-payment/{id}', [PaymentController::class, 'unactivePayment'])->name('payments.unactive_payment');

        //Products
        Route::resource('products', ProductController::class);
        Route::get('active-product/{id}', [ProductController::class, 'activeProduct'])->name('products.active_product');
        Route::get('unactive-product/{id}', [ProductController::class, 'unactiveProduct'])->name('products.unactive_product');
        Route::get('brands-ajax/{idItem}', [ProductController::class, 'getBand']);
        Route::get('categories-ajax/{idBrand}', [ProductController::class, 'getCategory']);
        // details category
        Route::post('product-details/{idProduct}', [ProductController::class, 'saveProductDetail'])->name('products.product_detail');
        Route::post('update-product-details/{idDetailProduct}', [ProductController::class, 'updateProductDetail'])->name('products.update_product_detail');

        // Order
        Route::get('manager-order', [ManagerOrder::class, 'manager_order'])->name('order.manager_order');
        Route::get('view-order/{order_id}', [ManagerOrder::class, 'view_order']);
        Route::post('update-status-order/{order_id}', [ManagerOrder::class, 'updateStatusOrder'])->name('order.update_status_order');

        // Customers
        Route::get('get-list-customer', [ManagerCustomerController::class, 'getListCustomer'])->name('customer.get_list_customer');
        Route::get('delete-customer/{customer_id}', [ManagerCustomerController::class, 'deleteCustomer'])->name('customer.delete_customer');

        //admin
        Route::get('acount-admin/{user_id}', [UserController::class, 'acountAdmin'])->name('admin.acount_admin');
        Route::get('edit-acount-admin/{user_id}', [UserController::class, 'editAcountAdmin'])->name('admin.edit_acount_admin');
        Route::post('update-acount-admin/{user_id}', [UserController::class, 'updateAcountAdmin'])->name('admin.update_acount_admin');
      });
});

// Sen mail
Route::get('send-mail', [MailController::class, 'send_mail']);

// Coupon
Route::get('all-coupon', [CouponController::class, 'all_coupon']);
Route::get('add-coupon', [CouponController::class, 'add_coupon']);
Route::post('save-coupon', [CouponController::class, 'save_coupon']);
Route::get('delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);

// Delivery
Route::get('all-delivery', [DeliveryController::class, 'all_delivery']);
Route::get('delivery', [DeliveryController::class, 'delivery']);
Route::post('add-delivery', [DeliveryController::class, 'add_delivery']);
Route::post('save-delivery', [DeliveryController::class, 'save_delivery']);
Route::post('update-delivery', [DeliveryController::class, 'update_delivery']);
