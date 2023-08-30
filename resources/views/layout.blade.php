<!doctype html>
<html class="no-js" lang="zxx">

<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{$title}}</title>
        <base href="{{ asset('') }}">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="frontend/images/thumbnail.png">
        <!-- Material Design Iconic Font-V2.2.0 -->
        <link rel="stylesheet" href="frontend/css/material-design-iconic-font.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="frontend/css/font-awesome.min.css">
        <!-- Font Awesome Stars-->
        <link rel="stylesheet" href="frontend/css/fontawesome-stars.css">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="frontend/css/meanmenu.css">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="frontend/css/owl.carousel.min.css">
        <!-- Slick Carousel CSS -->
        <link rel="stylesheet" href="frontend/css/slick.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="frontend/css/animate.css">
        <!-- Jquery-ui CSS -->
        <link rel="stylesheet" href="frontend/css/jquery-ui.min.css">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="frontend/css/venobox.css">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="frontend/css/nice-select.css">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="frontend/css/magnific-popup.css">
        <!-- Bootstrap V4.1.3 Fremwork CSS -->
        <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
        <!-- Helper CSS -->
        <link rel="stylesheet" href="frontend/css/helper.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="frontend/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="frontend/css/responsive.css">
        <!-- Modernizr js -->
        <script src="frontend/js/vendor/modernizr-2.8.3.min.js"></script>
        <link href="/frontend/css/sweetalert.css" rel="stylesheet">

        <link rel="stylesheet" href="frontend/main.css">
    </head>
    <body>
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
            <!-- Begin Header Area -->
            @include('inclu.header_top')
            @include('inclu.header_middle')
            @include('inclu.menu')

            @yield('content')

            @include('inclu.footer')
            <!-- Footer Area End Here -->
            <!-- Begin Quick View | Modal Area -->
            <div class="modal fade modal-wrapper" id="exampleModalCenter" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-inner-area row">
                                <div class="col-lg-5 col-md-6 col-sm-6">
                                   <!-- Product Details Left -->
                                    <div class="product-details-left">
                                        <div class="product-details-images slider-navigation-1">
                                            <div class="lg-image">
                                                <img src="frontend/images/product/large-size/1.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="frontend/images/product/large-size/2.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="frontend/images/product/large-size/3.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="frontend/images/product/large-size/4.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="frontend/images/product/large-size/5.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="frontend/images/product/large-size/6.jpg" alt="product image">
                                            </div>
                                        </div>
                                        <div class="product-details-thumbs slider-thumbs-1">
                                            <div class="sm-image"><img src="frontend/images/product/small-size/1.jpg" alt="product image thumb"></div>
                                            <div class="sm-image"><img src="frontend/images/product/small-size/2.jpg" alt="product image thumb"></div>
                                            <div class="sm-image"><img src="frontend/images/product/small-size/3.jpg" alt="product image thumb"></div>
                                            <div class="sm-image"><img src="frontend/images/product/small-size/4.jpg" alt="product image thumb"></div>
                                            <div class="sm-image"><img src="frontend/images/product/small-size/5.jpg" alt="product image thumb"></div>
                                            <div class="sm-image"><img src="frontend/images/product/small-size/6.jpg" alt="product image thumb"></div>
                                        </div>
                                    </div>
                                    <!--// Product Details Left -->
                                </div>

                                <div class="col-lg-7 col-md-6 col-sm-6">
                                    <div class="product-details-view-content pt-60">
                                        <div class="product-info">
                                            <h2>Today is a good day Framed poster</h2>
                                            <span class="product-details-ref">Reference: demo_15</span>
                                            <div class="rating-box pt-20">
                                                <ul class="rating rating-with-review-item">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="review-item"><a href="#">Read Review</a></li>
                                                    <li class="review-item"><a href="#">Write Review</a></li>
                                                </ul>
                                            </div>
                                            <div class="price-box pt-20">
                                                <span class="new-price new-price-2">$57.98</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>
                                                    <span>100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="product-variants">
                                                <div class="produt-variants-size">
                                                    <label>Dimension</label>
                                                    <select class="nice-select">
                                                        <option value="1" title="S" selected="selected">40x60cm</option>
                                                        <option value="2" title="M">60x90cm</option>
                                                        <option value="3" title="L">80x120cm</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="single-add-to-cart">
                                                <form action="#" class="cart-quantity">
                                                    <div class="quantity">
                                                        <label>Quantity</label>
                                                        <div class="cart-plus-minus">
                                                            <input class="cart-plus-minus-box" value="1" type="text">
                                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                        </div>
                                                    </div>
                                                    <button class="add-to-cart" type="submit">Add to cart</button>
                                                </form>
                                            </div>
                                            <div class="product-additional-info pt-25">
                                                <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                                <div class="product-social-sharing pt-25">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick View | Modal Area End Here -->
        </div>
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        <script src="frontend/js/vendor/jquery-1.12.4.min.js"></script>
        <!-- Popper js -->
        <script src="frontend/js/vendor/popper.min.js"></script>
        <!-- Bootstrap V4.1.3 Fremwork js -->
        <script src="frontend/js/bootstrap.min.js"></script>
        <!-- Ajax Mail js -->
        <script src="frontend/js/ajax-mail.js"></script>
        <!-- Meanmenu js -->
        <script src="frontend/js/jquery.meanmenu.min.js"></script>
        <!-- Wow.min js -->
        <script src="frontend/js/wow.min.js"></script>
        <!-- Slick Carousel js -->
        <script src="frontend/js/slick.min.js"></script>
        <!-- Owl Carousel-2 js -->
        <script src="frontend/js/owl.carousel.min.js"></script>
        <!-- Magnific popup js -->
        <script src="frontend/js/jquery.magnific-popup.min.js"></script>
        <!-- Isotope js -->
        <script src="frontend/js/isotope.pkgd.min.js"></script>
        <!-- Imagesloaded js -->
        <script src="frontend/js/imagesloaded.pkgd.min.js"></script>
        <!-- Mixitup js -->
        <script src="frontend/js/jquery.mixitup.min.js"></script>
        <!-- Countdown -->
        <script src="frontend/js/jquery.countdown.min.js"></script>
        <!-- Counterup -->
        <script src="frontend/js/jquery.counterup.min.js"></script>
        <!-- Waypoints -->
        <script src="frontend/js/waypoints.min.js"></script>
        <!-- Barrating -->
        <script src="frontend/js/jquery.barrating.min.js"></script>
        <!-- Jquery-ui -->
        <script src="frontend/js/jquery-ui.min.js"></script>
        <!-- Venobox -->
        <script src="frontend/js/venobox.min.js"></script>
        <!-- Nice Select js -->
        <script src="frontend/js/jquery.nice-select.min.js"></script>
        <!-- ScrollUp js -->
        <script src="frontend/js/scrollUp.min.js"></script>
        <!-- Main/Activator js -->
        <script src="frontend/js/main.js"></script>
        <script src="/frontend/js/sweetalert.min.js"></script>
        @yield('script')

        {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
        {{-- <script type="text/javascript">
            $(document).ready(function() {
                $('.add-to-cart').click(function() {
                    if(confirm("Bấm vào nút OK để tiếp tục") == true){
                        swal("Thêm sản phẩm vào giỏ hàng thành công!");
                    }else{
                        swal("Thêm sản phẩm vào giỏ hàng thất bại!");
                    }
                    swal("Thêm sản phẩm vào giỏ hàng thành công!");
                });
            });
        </script> --}}
    </body>

<!-- index-231:38-->
</html>