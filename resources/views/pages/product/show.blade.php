@extends('layout')
@section('content')

<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-1 order-lg-2">
                <!-- Begin Li's Banner Area -->
                <div class="single-banner shop-page-banner">
                    <div class="li-static-home">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Begin Li's Static Home Image Area -->
                                    <div class="li-static-home-image"></div>
                                    <!-- Li's Static Home Image Area End Here -->
                                    <!-- Begin Li's Static Home Content Area -->
                                    <div class="li-static-home-content">
                                        <p>Ưu đãi giảm giá<span>-20% </span>Trong tuần này</p>
                                        <h2>Sản phẩm nổi bật</h2>
                                        <h2>Phụ Kiện Aplle 2023</h2>
                                    </div>
                                    <!-- Li's Static Home Content Area End Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Li's Banner Area End Here -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    @foreach ($all_product['data'] as $all)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{ URL::to('details-product/'.$all->product_id) }}">
                                                    <img src="{{ URL::to('/uploads/product/'. $all->product_image) }}" alt="Li's Product Image" class="img-show-product img-home width-img">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                    <h4>
                                                        <a
                                                            class="product_name format-text-2-line"
                                                            href="{{ URL::to('details-product/'.$all->product_id) }}"
                                                        >
                                                            {{ $all->product_name }}
                                                        </a>
                                                    </h4>
                                                    <div class="price-box">
                                                        @if (isset($all->product_old_price) && $all->product_old_price > 0)
                                                            <span class="new-price new-price-2">{{ number_format($all->product_price).'.'.'₫' }}</span>
                                                            <br>
                                                            <span class="old-price">{{ number_format($all->product_old_price).'.'.'₫' }}</span>
                                                            <span class="discount-percentage">
                                                                <?php
                                                                    $percent = (($all->product_old_price*100) - ($all->product_price *100)) / $all->product_old_price
                                                                ?>
                                                                <?= - round($percent).'%'?>
                                                            </span>
                                                        @else
                                                            <span class="new-price new-price-2">{{ number_format($all->product_price).'.'.'₫' }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <form action="{{ route('cart.save_cart') }}" method="POST">
                                                        @csrf
                                                        <input value="1" type="hidden" name="qty">
                                                        <input type="hidden" name="product_id_hidden" value="{{ $all->product_id }}">
                                                        <button
                                                            class="add-to-cart btn btn-primary"
                                                            type="submit"
                                                            onclick="return confirm('Bạn có chắc muốn mua sản phẩm này không?')"
                                                            >
                                                            Thêm giỏ hàng
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- </a> --}}
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="paginatoin-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 pt-xs-15">
                                    <p></p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul class="pagination-box pt-xs-20 pb-xs-15 paginate-show-product">
                                        {{ $all_product['data']->links("pagination::bootstrap-4") }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->

@endsection