@extends('layout')
@section('content')

<!-- content-wraper start -->
<div class="content-wraper">
  <div class="container">
      <div class="row single-product-area">
          <div class="col-lg-5 col-md-6">
             <!-- Product Details Left -->
              <div class="product-details-left">
                  <div class="product-details-images slider-navigation-1">
                      <div class="lg-image">
                          <a class="popup-img venobox vbox-item" href="{{ URL::to('/uploads/product/'. $details['data']['details']->product_image) }}" data-gall="myGallery">
                              <img src="{{ URL::to('/uploads/product/'. $details['data']['details']->product_image) }}" alt="product image" class="img-detail-product">
                          </a>
                      </div>
                      {{-- <div class="lg-image">
                          <a class="popup-img venobox vbox-item" href="frontend/images/product/large-size/2.jpg" data-gall="myGallery">
                              <img src="frontend/images/product/large-size/2.jpg" alt="product image">
                          </a>
                      </div>
                      <div class="lg-image">
                          <a class="popup-img venobox vbox-item" href="frontend/images/product/large-size/3.jpg" data-gall="myGallery">
                              <img src="frontend/images/product/large-size/3.jpg" alt="product image">
                          </a>
                      </div>
                      <div class="lg-image">
                          <a class="popup-img venobox vbox-item" href="frontend/images/product/large-size/4.jpg" data-gall="myGallery">
                              <img src="frontend/images/product/large-size/4.jpg" alt="product image">
                          </a>
                      </div>
                      <div class="lg-image">
                          <a class="popup-img venobox vbox-item" href="frontend/images/product/large-size/5.jpg" data-gall="myGallery">
                              <img src="frontend/images/product/large-size/5.jpg" alt="product image">
                          </a>
                      </div>
                      <div class="lg-image">
                          <a class="popup-img venobox vbox-item" href="frontend/images/product/large-size/6.jpg" data-gall="myGallery">
                              <img src="frontend/images/product/large-size/6.jpg" alt="product image">
                          </a>
                      </div> --}}
                  </div>
                  {{-- <div class="product-details-thumbs slider-thumbs-1">
                      <div class="sm-image"><img src="frontend/images/product/small-size/1.jpg" alt="product image thumb"></div>
                      <div class="sm-image"><img src="frontend/images/product/small-size/2.jpg" alt="product image thumb"></div>
                      <div class="sm-image"><img src="frontend/images/product/small-size/3.jpg" alt="product image thumb"></div>
                      <div class="sm-image"><img src="frontend/images/product/small-size/4.jpg" alt="product image thumb"></div>
                      <div class="sm-image"><img src="frontend/images/product/small-size/5.jpg" alt="product image thumb"></div>
                      <div class="sm-image"><img src="frontend/images/product/small-size/6.jpg" alt="product image thumb"></div>
                  </div> --}}
              </div>
              <!--// Product Details Left -->
          </div>

          <div class="col-lg-7 col-md-6">
              <div class="product-details-view-content pt-60">
                  <div class="product-info">
                      <h2>{{ $details['data']['details']->product_name }}</h2>
                      {{-- <span class="product-details-ref">Reference: demo_15</span> --}}
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
                          {{-- <span class="new-price new-price-2">$57.98</span> --}}
                            @if (isset($details['data']['details']->product_old_price) && $details['data']['details']->product_old_price > 0)
                                <span class="new-price new-price-2">{{ number_format($details['data']['details']->product_price).'.'.'₫' }}</span>
                                <br>
                                <del>
                                    <span class="old-price">{{ number_format($details['data']['details']->product_old_price).'.'.'₫' }}</span>
                                </del>
                                <span
                                    class="discount-percentage discount-percentage-detail-product"
                                >
                                    <?php
                                        $percent = (($details['data']['details']->product_old_price*100) - ($details['data']['details']->product_price *100)) / $details['data']['details']->product_old_price
                                    ?>
                                    <?= - round($percent).'%'?>
                                </span>
                            @else
                                <span class="new-price new-price-2">{{ number_format($details['data']['details']->product_price).'.'.'₫' }}</span>
                            @endif
                      </div>
                      <div class="product-desc">
                          <p>
                              <span>{{ $details['data']['details']->desc }}</span>
                          </p>
                      </div>
                      {{-- <div class="product-variants">
                          <div class="produt-variants-size">
                              <label>Dimension</label>
                              <select class="nice-select">
                                  <option value="1" title="S" selected="selected">40x60cm</option>
                                  <option value="2" title="M">60x90cm</option>
                                  <option value="3" title="L">80x120cm</option>
                              </select>
                          </div>
                      </div> --}}
                      <div class="single-add-to-cart">
                          <form action="{{ route('cart.save_cart') }}" class="cart-quantity" method="POST">
                            @csrf
                                <div class="quantity">
                                  <label>Số lượng</label>
                                  <div class="cart-plus-minus">
                                      <input class="cart-plus-minus-box" value="1" type="number" min="1" name="qty">
                                      <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                      <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                  </div>
                                  <input type="hidden" name="product_id_hidden" value="{{ $details['data']['details']->product_id }}">
                              </div>
                              <button
                                class="add-to-cart"
                                type="submit"
                                onclick="return confirm('Bạn có chắc muốn mua sản phẩm này không?')"
                                >
                                Thêm giỏ hàng
                                </button>
                          </form>
                      </div>
                      <div class="product-additional-info pt-25">
                          {{-- <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a> --}}
                          <div class="product-social-sharing pt-25">
                              <ul>
                                  <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                  <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                  <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                  <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="block-reassurance">
                          <ul>
                              <li>
                                  <div class="reassurance-item">
                                      <div class="reassurance-icon">
                                          <i class="fa fa-check-square-o"></i>
                                      </div>
                                      <p>Chính sách bảo mật (chỉnh sửa với mô-đun Đảm bảo khách hàng)</p>
                                  </div>
                              </li>
                              <li>
                                  <div class="reassurance-item">
                                      <div class="reassurance-icon">
                                          <i class="fa fa-truck"></i>
                                      </div>
                                      <p>Chính sách giao hàng (chỉnh sửa với mô-đun Đảm bảo khách hàng)</p>
                                  </div>
                              </li>
                              <li>
                                  <div class="reassurance-item">
                                      <div class="reassurance-icon">
                                          <i class="fa fa-exchange"></i>
                                      </div>
                                      <p>Chính sách hoàn trả (chỉnh sửa với mô-đun Đảm bảo khách hàng)</p>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="li-product-tab">
                  <ul class="nav li-product-menu">
                     <li><a class="active" data-toggle="tab" href="#description"><span>Chi tiết sản phẩm</span></a></li>
                     <li><a data-toggle="tab" href="#product-details"><span>Nội dung</span></a></li>
                     {{-- <li><a data-toggle="tab" href="#reviews"><span>Comment</span></a></li> --}}
                  </ul>
              </div>
              <!-- Begin Li's Tab Menu Content Area -->
          </div>
      </div>
      <div class="tab-content">
          <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    <table class="table table-hover table-light">
                        <tr>
                            <td>CPU:</td>
                            <td class="text-info">{{ $details['data']['details']->cpu }}</td>
                        </tr>
                        <tr>
                            <td>RAM:</td>
                            <td class="text-info">{{ $details['data']['details']->ram }}</td>
                        </tr>
                        <tr>
                            <td>Ổ cứng:</td>
                            <td class="text-info">{{ $details['data']['details']->hard_drive }}</td>
                        </tr>
                        <tr>
                            <td>Màn hình:</td>
                            <td class="text-info">{{ $details['data']['details']->screen }}</td>
                        </tr>
                        <tr>
                            <td>Card màn hình:</td>
                            <td class="text-info">{{ $details['data']['details']->card_screen }}</td>
                        </tr>
                        <tr>
                            <td>Cổng kết nối:</td>
                            <td class="text-info">{{ $details['data']['details']->connection }}</td>
                        </tr>
                        <tr>
                            <td>Đặc biệt:</td>
                            <td class="text-info">{{ $details['data']['details']->especially }}</td>
                        </tr>
                        <tr>
                            <td>Hệ điều hành:</td>
                            <td class="text-info">{{ $details['data']['details']->operating_system }}</td>
                        </tr>
                        <tr>
                            <td>Thiết kế:</td>
                            <td class="text-info">{{ $details['data']['details']->design }}</td>
                        </tr>
                        <tr>
                            <td>Kích thước, khối lượng:</td>
                            <td class="text-info">{{ $details['data']['details']->size_mass }}</td>
                        </tr>
                        <tr>
                            <td>Thời điểm ra mắt:</td>
                            <td class="text-info">{{ $details['data']['details']->release_time }}</td>
                        </tr>
                    </table>
                </div>
          </div>
          <div id="product-details" class="tab-pane" role="tabpanel">
              <div class="product-details-manufacturer">
                  <p><span>{{ $details['data']['details']->content }}</span></p>
              </div>
          </div>
          <div id="reviews" class="tab-pane" role="tabpanel">
              <div class="product-reviews">
                  <div class="product-details-comment-block">
                      <div class="comment-review">
                          <span>Grade</span>
                          <ul class="rating">
                              <li><i class="fa fa-star-o"></i></li>
                              <li><i class="fa fa-star-o"></i></li>
                              <li><i class="fa fa-star-o"></i></li>
                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                          </ul>
                      </div>
                      <div class="comment-author-infos pt-25">
                          <span>HTML 5</span>
                          <em>01-12-18</em>
                      </div>
                      <div class="comment-details">
                          <h4 class="title-block">Demo</h4>
                          <p>Plaza</p>
                      </div>
                      <div class="review-btn">
                          <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a>
                      </div>
                      <!-- Begin Quick View | Modal Area -->
                      <div class="modal fade modal-wrapper" id="mymodal" >
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-body">
                                      <h3 class="review-page-title">Write Your Review</h3>
                                      <div class="modal-inner-area row">
                                          <div class="col-lg-6">
                                             <div class="li-review-product">
                                                 <img src="frontend/images/product/large-size/3.jpg" alt="Li's Product">
                                                 <div class="li-review-product-desc">
                                                     <p class="li-product-name">Today is a good day Framed poster</p>
                                                     <p>
                                                         <span>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite Sound via Ring Radiator Technology. Stream And Control R3 Speakers Wirelessly With Your Smartphone. Sophisticated, Modern Design </span>
                                                     </p>
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                              <div class="li-review-content">
                                                  <!-- Begin Feedback Area -->
                                                  <div class="feedback-area">
                                                      <div class="feedback">
                                                          <h3 class="feedback-title">Our Feedback</h3>
                                                          <form action="#">
                                                              <p class="your-opinion">
                                                                  <label>Your Rating</label>
                                                                  <span>
                                                                      <select class="star-rating">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                      </select>
                                                                  </span>
                                                              </p>
                                                              <p class="feedback-form">
                                                                  <label for="feedback">Your Review</label>
                                                                  <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                              </p>
                                                              <div class="feedback-input">
                                                                  <p class="feedback-form-author">
                                                                      <label for="author">Name<span class="required">*</span>
                                                                      </label>
                                                                      <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                                  </p>
                                                                  <p class="feedback-form-author feedback-form-email">
                                                                      <label for="email">Email<span class="required">*</span>
                                                                      </label>
                                                                      <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                                      <span class="required"><sub>*</sub> Required fields</span>
                                                                  </p>
                                                                  <div class="feedback-btn pb-15">
                                                                      <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                                                                      <a href="#">Submit</a>
                                                                  </div>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                                  <!-- Feedback Area End Here -->
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Quick View | Modal Area End Here -->
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-30 pb-50">
  <div class="container">
      <div class="row">
          <!-- Begin Li's Section Area -->
          <div class="col-lg-12">
              <div class="li-section-title">
                  <h2>
                      <span>10 sản phẩm tương tự khác:</span>
                  </h2>
              </div>
              <div class="row">
                  <div class="product-active owl-carousel">
                    @foreach ($details['data']['ortherSame'] as $orther)
                      <div class="col-lg-12">
                          <!-- single-product-wrap start -->
                          <div class="single-product-wrap">
                                <a href="{{ URL::to('details-product/'.$orther->product_id) }}">
                                    <div class="product-image">
                                        {{-- <a href="single-product.html"> --}}
                                        <img src="{{ URL::to('/uploads/product/'. $orther->product_image) }}" alt="Li's Product Image">
                                        {{-- </a> --}}
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                {{-- <h5 class="manufacturer">
                                                    <a href="product-details.html">Graphic Corner</a>
                                                </h5> --}}
                                                {{-- <div class="rating-box"> --}}
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                {{-- </div> --}}
                                            </div>
                                            <h4
                                                class="product_name format-text-2-line"
                                            >
                                                    {{-- <a  href="single-product.html"> --}}
                                                    {{ $orther->product_name }}
                                                    {{-- </a> --}}
                                                </h4>
                                                <div class="price-box">
                                                    @if (isset($orther->product_old_price) && $orther->product_old_price > 0)
                                                        <span class="new-price new-price-2">{{ number_format($orther->product_price).'.'.'₫' }}</span>
                                                        <br>
                                                        <span class="old-price">{{ number_format($orther->product_old_price).'.'.'₫' }}</span>
                                                        <span class="discount-percentage">
                                                            <?php
                                                                $percent = (($orther->product_old_price*100) - ($orther->product_price *100)) / $orther->product_old_price
                                                            ?>
                                                            <?= - round($percent).'%'?>
                                                        </span>
                                                    @else
                                                        <span class="new-price new-price-2">{{ number_format($orther->product_price).'.'.'₫' }}</span>
                                                    @endif
                                                </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                          </div>
                          <!-- single-product-wrap end -->
                      </div>
                      {{-- <div class="col-lg-12">
                          <!-- single-product-wrap start -->
                          <div class="single-product-wrap">
                              <div class="product-image">
                                  <a href="single-product.html">
                                      <img src="frontend/images/product/large-size/2.jpg" alt="Li's Product Image">
                                  </a>
                                  <span class="sticker">New</span>
                              </div>
                              <div class="product_desc">
                                  <div class="product_desc_info">
                                      <div class="product-review">
                                          <h5 class="manufacturer">
                                              <a href="product-details.html">Studio Design</a>
                                          </h5>
                                          <div class="rating-box">
                                              <ul class="rating">
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                              </ul>
                                          </div>
                                      </div>
                                      <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                      <div class="price-box">
                                          <span class="new-price new-price-2">$71.80</span>
                                          <span class="old-price">$77.22</span>
                                          <span class="discount-percentage">-7%</span>
                                      </div>
                                  </div>
                                  <div class="add-actions">
                                      <ul class="add-actions-link">
                                          <li class="add-cart active"><a href="#">Add to cart</a></li>
                                          <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                          <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <!-- single-product-wrap end -->
                      </div>
                      <div class="col-lg-12">
                          <!-- single-product-wrap start -->
                          <div class="single-product-wrap">
                              <div class="product-image">
                                  <a href="single-product.html">
                                      <img src="frontend/images/product/large-size/3.jpg" alt="Li's Product Image">
                                  </a>
                                  <span class="sticker">New</span>
                              </div>
                              <div class="product_desc">
                                  <div class="product_desc_info">
                                      <div class="product-review">
                                          <h5 class="manufacturer">
                                              <a href="product-details.html">Graphic Corner</a>
                                          </h5>
                                          <div class="rating-box">
                                              <ul class="rating">
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                              </ul>
                                          </div>
                                      </div>
                                      <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                      <div class="price-box">
                                          <span class="new-price">$46.80</span>
                                      </div>
                                  </div>
                                  <div class="add-actions">
                                      <ul class="add-actions-link">
                                          <li class="add-cart active"><a href="#">Add to cart</a></li>
                                          <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                          <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <!-- single-product-wrap end -->
                      </div>
                      <div class="col-lg-12">
                          <!-- single-product-wrap start -->
                          <div class="single-product-wrap">
                              <div class="product-image">
                                  <a href="single-product.html">
                                      <img src="frontend/images/product/large-size/4.jpg" alt="Li's Product Image">
                                  </a>
                                  <span class="sticker">New</span>
                              </div>
                              <div class="product_desc">
                                  <div class="product_desc_info">
                                      <div class="product-review">
                                          <h5 class="manufacturer">
                                              <a href="product-details.html">Studio Design</a>
                                          </h5>
                                          <div class="rating-box">
                                              <ul class="rating">
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                              </ul>
                                          </div>
                                      </div>
                                      <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                      <div class="price-box">
                                          <span class="new-price new-price-2">$71.80</span>
                                          <span class="old-price">$77.22</span>
                                          <span class="discount-percentage">-7%</span>
                                      </div>
                                  </div>
                                  <div class="add-actions">
                                      <ul class="add-actions-link">
                                          <li class="add-cart active"><a href="#">Add to cart</a></li>
                                          <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                          <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <!-- single-product-wrap end -->
                      </div>
                      <div class="col-lg-12">
                          <!-- single-product-wrap start -->
                          <div class="single-product-wrap">
                              <div class="product-image">
                                  <a href="single-product.html">
                                      <img src="frontend/images/product/large-size/5.jpg" alt="Li's Product Image">
                                  </a>
                                  <span class="sticker">New</span>
                              </div>
                              <div class="product_desc">
                                  <div class="product_desc_info">
                                      <div class="product-review">
                                          <h5 class="manufacturer">
                                              <a href="product-details.html">Graphic Corner</a>
                                          </h5>
                                          <div class="rating-box">
                                              <ul class="rating">
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                              </ul>
                                          </div>
                                      </div>
                                      <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                      <div class="price-box">
                                          <span class="new-price">$46.80</span>
                                      </div>
                                  </div>
                                  <div class="add-actions">
                                      <ul class="add-actions-link">
                                          <li class="add-cart active"><a href="#">Add to cart</a></li>
                                          <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                          <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <!-- single-product-wrap end -->
                      </div>
                      <div class="col-lg-12">
                          <!-- single-product-wrap start -->
                          <div class="single-product-wrap">
                              <div class="product-image">
                                  <a href="single-product.html">
                                      <img src="frontend/images/product/large-size/6.jpg" alt="Li's Product Image">
                                  </a>
                                  <span class="sticker">New</span>
                              </div>
                              <div class="product_desc">
                                  <div class="product_desc_info">
                                      <div class="product-review">
                                          <h5 class="manufacturer">
                                              <a href="product-details.html">Studio Design</a>
                                          </h5>
                                          <div class="rating-box">
                                              <ul class="rating">
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                              </ul>
                                          </div>
                                      </div>
                                      <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                      <div class="price-box">
                                          <span class="new-price new-price-2">$71.80</span>
                                          <span class="old-price">$77.22</span>
                                          <span class="discount-percentage">-7%</span>
                                      </div>
                                  </div>
                                  <div class="add-actions">
                                      <ul class="add-actions-link">
                                          <li class="add-cart active"><a href="#">Add to cart</a></li>
                                          <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                          <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <!-- single-product-wrap end -->
                      </div> --}}
                    @endforeach
                  </div>
              </div>
          </div>
          <!-- Li's Section Area End Here -->
      </div>
  </div>
</section>
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Footer Area -->

@endsection