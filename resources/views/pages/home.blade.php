@extends('layout')
@section('content')

<!-- Header Area End Here -->
            <!-- Begin Slider With Category Menu Area -->
            <div class="slider-with-banner">
                <div class="container">
                    <div class="row">
                        <!-- Begin Category Menu Area -->
                        <div class="col-lg-3">
                            <!--Category Menu Start-->
                            <div class="category-menu">
                                <div class="category-heading">
                                    <h2 class="categories-toggle"><span>categories</span></h2>
                                </div>
                                <div id="cate-toggle" class="category-menu-list">
                                    <ul>
                                        @foreach ($item_type['data'] as $item)
                                            <li class="right-menu"><a href="{{ URL::to('show-products-by-item/'.$item->item_id) }}">{{ $item->item_name }}</a>
                                                <ul class="cat-mega-menu">
                                                    @foreach ($brand_product['data'] as $brand)
                                                        @if ($brand->item_id == $item->item_id)
                                                        <li class="right-menu cat-mega-title">
                                                            <a href="{{ URL::to('show-products-by-brand/'.$brand->brand_id) }}">{{ $brand->brand_name }}</a>
                                                                @foreach ($cate_product['data'] as $cate)
                                                                    @if ($cate->brand_id == $brand->brand_id)
                                                                        <ul>
                                                                            <li><a href="{{ URL::to('show-products-by-category/'.$cate->category_id) }}">{{$cate->category_name}}</a></li>
                                                                        </ul>
                                                                    @endif
                                                                @endforeach
                                                        </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                        <li class="rx-parent">
                                            <a class="rx-default">More Categories</a>
                                            <a class="rx-show">Less Categories</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--Category Menu End-->
                        </div>
                        <!-- Category Menu Area End Here -->
                        <!-- Begin Slider Area -->
                        <div class="col-lg-9">
                            <div class="slider-area pt-sm-30 pt-xs-30">
                                <div class="slider-active owl-carousel">
                                    <!-- Begin Single Slide Area -->
                                    <div class="single-slide align-center-left animation-style-02 bg-6">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            <h5>Ưu đãi giảm giá <span>-10% </span> Trong tuần này</h5>
                                            <h2>Phantom 4 Pro+ Obsidian</h2>
                                            <h3>Starting at <span>2,390,000₫</span></h3>

                                        </div>
                                    </div>
                                    <div class="single-slide align-center-left animation-style-02 bg-2">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            <h5>Ưu đãi giảm giá <span>Black Friday</span> Trong tuần này</h5>
                                            <h2>Work Desk Surface Studio 2023</h2>
                                            <h3>Starting at <span>18,128,000₫</span></h3>
                                        </div>
                                    </div>
                                    <!-- Single Slide Area End Here -->
                                </div>
                            </div>
                        </div>
                        <!-- Slider Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider With Category Menu Area End Here -->
            <!-- Begin Li's Static Banner Area -->
            <div class="li-static-banner pt-20 pt-sm-30 pt-xs-30">
                <div class="container">
                    <div class="row">
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-4 col-md-4">
                            <div class="single-banner pb-xs-30">
                                <a href="#">
                                    <img src="frontend/images/banner/3_1.jpg" alt="Li's Static Banner" class="height-img">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-4 col-md-4">
                            <div class="single-banner pb-xs-30">
                                <a href="#">
                                    <img src="frontend/images/banner/1_1.jpg" alt="Li's Static Banner" class="height-img">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-4 col-md-4">
                            <div class="single-banner">
                                <a href="#">
                                    <img src="frontend/images/banner/1_5.jpg" alt="Li's Static Banner">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Li's Static Banner Area End Here -->
            <!-- Begin Li's Special Product Area -->
            <section class="product-area li-laptop-product Special-product pt-60 pb-45">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
            </section>
            <!-- Li's Special Product Area End Here -->
            <!-- Begin Li's Laptops Product | Home V2 Area -->
            <section class="product-area li-laptop-product li-laptop-product-2 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Laptops</span>
                                </h2>
                            </div>
                            <div class="li-banner-2 pt-15">
                                <div class="row">
                                    <!-- Begin Single Banner Area -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-banner ">
                                            <a href="#">
                                                <img src="frontend/images/banner/banner1.png" alt="Li's Static Banner" class="height-img-banner">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Single Banner Area End Here -->
                                    <!-- Begin Single Banner Area -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-banner pt-xs-30">
                                            <a href="#">
                                                <img src="frontend/images/banner/banner2.jpg" alt="Li's Static Banner" class="height-img-banner">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Single Banner Area End Here -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach ($all_laptop['data'] as $all)
                                    <div class="col-lg-12">
                                        <div class="single-product-wrap">
                                            <a href="{{ URL::to('details-product/'.$all->product_id) }}">
                                                <div class="product-image">
                                                    <img src="{{ URL::to('/uploads/product/'. $all->product_image) }}" alt="Li's Product Image" class="img-home">
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
                                                        <h4
                                                            class="product_name format-text-2-line"
                                                            >{{ $all->product_name }}
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
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            <!-- Li's Laptops Product | Home V2 Area End Here -->

            <!-- Begin Li's Smart Phone Product Area -->
            <section class="product-area li-laptop-product li-smart-phone-product-2 pb-50">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Điện thoại</span>
                                </h2>
                            </div>
                            <div class="li-banner-2 pt-15">
                                <div class="row">
                                    <!-- Begin Single Banner Area -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-banner">
                                            <a href="#">
                                                <img src="frontend/images/banner/banner5.jpg" alt="Li's Static Banner" class="height-img-banner">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Single Banner Area End Here -->
                                    <!-- Begin Single Banner Area -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-banner pt-xs-30">
                                            <a href="#">
                                                <img src="frontend/images/banner/banner3.jpg" alt="Li's Static Banner" class="height-img-banner">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Single Banner Area End Here -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach ($allSmartphone['data'] as $all)
                                    <div class="col-lg-12">
                                        <div class="single-product-wrap">
                                            <a href="{{ URL::to('details-product/'.$all->product_id) }}">
                                                <div class="product-image">
                                                        <img src="{{ URL::to('/uploads/product/'. $all->product_image) }}" alt="Li's Product Image" class="img-home width-img">
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
                                                        <h4
                                                            class="product_name format-text-2-line"
                                                            >{{ $all->product_name }}
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
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            <!-- Li's Smart Phone Product Area End Here -->
            <!-- Begin Li's Static Home Area -->
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

            <!-- Li's Static Home Area End Here -->
            <!-- Begin Li's Trending Product | Home V2 Area -->
            <section class="product-area li-trending-product li-trending-product-2 pt-60 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Tab Menu Area -->
                        <div class="col-lg-12">
                            <div class="li-product-tab li-trending-product-tab">
                                <h2>
                                    <span>Tai nghe</span>
                                </h2>
                                <ul class="nav li-product-menu li-trending-product-menu">
                                   <li><a class="active" data-toggle="tab" href="#home1"><span></span></a></li>
                                   <li><a data-toggle="tab" href="#home2"><span></span></a></li>
                                   <li><a data-toggle="tab" href="#home3"><span></span></a></li>
                                </ul>
                            </div>
                            <!-- Begin Li's Tab Menu Content Area -->
                            <div class="tab-content li-tab-content li-trending-product-content">
                                <div id="home1" class="tab-pane show fade in active">
                                    <div class="row">
                                        <div class="product-active owl-carousel">
                                            @foreach ($allHeadphone['data'] as $all)
                                            <div class="col-lg-12">
                                                <div class="single-product-wrap">
                                                    <a href="{{ URL::to('details-product/'.$all->product_id) }}">
                                                        <div class="product-image">
                                                            <img src="{{ URL::to('/uploads/product/'. $all->product_image) }}" alt="Li's Product Image" class="img-home width-img">
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
                                                                <h4
                                                                    class="product_name format-text-2-line"
                                                                    >{{ $all->product_name }}
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
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab Menu Content Area End Here -->
                        </div>
                        <!-- Tab Menu Area End Here -->
                    </div>
                </div>
            </section>
            <!-- Li's Trending Product | Home V2 Area End Here -->
            <!-- Begin Footer Area -->

@endsection
