<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
  <div class="container">
      <div class="row">
          <!-- Begin Header Logo Area -->
          <div class="col-lg-3">
              <div class="logo pb-sm-30 pb-xs-30">
                  <a href="/">
                      <img src="frontend/images/menu/logo/1.jpg" alt="">
                  </a>
              </div>
          </div>
          <!-- Header Logo Area End Here -->
          <!-- Begin Header Middle Right Area -->
          <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
              <!-- Begin Header Middle Searchbox Area -->
                <form action="{{ route('search')}}" class="hm-searchbox" method="POST">
                @csrf
                  <input type="text" name="keywords_submit" placeholder="Bạn tìm gì ...">
                  <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
              <!-- Header Middle Searchbox Area End Here -->
              <!-- Begin Header Middle Right Area -->
              <div class="header-middle-right">
                  <ul class="hm-menu">
                      <?php
                        $contents = Cart::content();
                        $countCart = count($contents);
                        $count = 0;
                      ?>
                      <li class="hm-minicart">
                          <div class="hm-minicart-trigger">
                              <span class="item-icon"></span>
                              <span class="item-text">{{ Cart::pricetotal(0, ',', '.').' '.'đ' }}
                                  <span class="cart-item-count">{{$countCart}}</span>
                              </span>
                          </div>
                          <span></span>
                            <div class="minicart">
                                <ul class="minicart-product-list">
                                  @foreach ($contents as $key => $content)
                                  <?php
                                    $count++;
                                  ?>
                                  @if ($count <= 2)
                                  <li>
                                      <a href="{{ URL::to('details-product/'.$content->id) }}" class="minicart-product-image margin-top">
                                        <img src="{{ URL::to('/uploads/product/'.$content->options->image) }}" alt="cart products" class="img-cart">
                                      </a>
                                      <div class="minicart-product-details">
                                        <h6>
                                          <a href="{{ URL::to('details-product/'.$content->id) }}" class="product_name format-text-2-line">
                                            {{ $content->name }}
                                          </a>
                                        </h6>
                                        <span>{{ number_format($content->price, 0, ',', '.').' '.'đ' }} x {{ $content->qty }}</span>
                                      </div>
                                  </li>
                                  @endif
                                  @endforeach
                              </ul>
                              <p class="minicart-total">Tổng tiền: <span>{{ Cart::pricetotal(0, ',', '.').' '.'đ' }}</span></p>
                              <div class="minicart-button">
                                  <a href="{{ URL::to('show-cart') }}" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                                      <span>Giỏ hàng</span>
                                  </a>
                                    <?php
                                        $customer_id = Auth::guard('customer')->check();
                                        $name = Session::get('customer_name');
                                        if ($customer_id != null) {
                                    ?>
                                        <a href="{{ URL::to('checkout') }}" class="li-button li-button-fullwidth li-button-sm text-danger">Thanh toán</a>
                                    <?php
                                        } else {
                                    ?>
                                        <a href="{{ URL::to('login-checkout') }}" class="li-button li-button-fullwidth li-button-sm text-danger">Thanh toán</a>
                                    <?php
                                        }
                                    ?>
                              </div>
                          </div>
                      </li>
                      <!-- Header Mini Cart Area End Here -->
                  </ul>
              </div>
              <!-- Header Middle Right Area End Here -->
          </div>
          <!-- Header Middle Right Area End Here -->
      </div>
  </div>
</div>