@extends('layout')
@section('content')

<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    <?php
                        $contents = Cart::content();
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="li-product-remove">Xóa</th>
                                <th class="li-product-thumbnail">Ảnh</th>
                                <th class="cart-product-name">Sản phẩm</th>
                                <th class="li-product-price">Giá</th>
                                <th class="li-product-quantity">Số lượng</th>
                                <th class="li-product-subtotal">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                            <tr>
                                <td class="li-product-remove">
                                    <a href="{{ route('cart.delete_to_cart', [$content->rowId]) }}">
                                    <i class="fa fa-times"></i>
                                    </a>
                                </td>
                                <td class="li-product-thumbnail">
                                    <a href="{{ URL::to('details-product/'.$content->id) }}">
                                    <img src="{{ URL::to('/uploads/product/'.$content->options->image) }}" width="150px" alt="Li's Product Image">
                                    </a>
                                </td>
                                <td class="li-product-name"><a href="{{ URL::to('details-product/'.$content->id) }}">{{ $content->name }}</a></td>
                                <td class="li-product-price"><span class="amount">{{ number_format($content->price, 0, ',', '.').' '.'đ' }}</span></td>
                                <td class="quantity">
                                    <form action="{{ route('cart.update_cart_quantity') }}" method="POST">
                                        @csrf
                                        <div class="">
                                            <input
                                                class="input-group-text text-danger btn-update-cart text-image"
                                                value="{{ $content->qty }}" type="number" min="1"
                                                name="cart_quantity"
                                            >
                                            <input type="hidden" value="{{ $content->rowId }}" name="rowId_cart" class="form-control">
                                        </div>
                                        <button type="submit" class="btn-primary btn-update-cart">Cập nhật</button>
                                    </form>
                                </td>
                                {{-- <td class="product-subtotal"><span class="amount">{{ cart::Subtotal() }}</span></td> --}}
                                <td class="product-subtotal">
                                    <span class="amount">
                                        <?php
                                            $subtotal = $content->price * $content->qty;
                                            echo number_format($content->subtotal, 0, ',', '.').' '.'đ';
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            <h2>Tổng giỏ hàng</h2>
                            <ul>
                                <li>Tổng <span>{{ Cart::pricetotal(0, ',', '.').' '.'đ' }}</span></li>
                                <li>Thuế <span>{{ Cart::tax(0, ',', '.').' '.'đ' }}</span></li>
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li>Thành tiền <span>{{ Cart::total(0, ',', '.').' '.'đ' }}</span></li>
                            </ul>
                            <?php
                                $customer_id = Auth::guard('customer')->check();
                                if ($customer_id != null) {
                            ?>
                                <a class="btn btn-default check_out" href="{{ URL::to('checkout') }}">Thanh toán</a>
                            <?php
                            } else {
                            ?>
                                <a class="btn btn-default check_out" href="{{ route('customer.login_checkout') }}">Thanh toán</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->

@endsection