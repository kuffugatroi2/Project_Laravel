<header>
  <div class="header-top">
      <div class="container">
          <div class="row">
              <!-- Begin Header Top Left Area -->
              <div class="col-lg-3 col-md-4">
                  <div class="header-top-left">
                      <ul class="phone-wrap">
                            <li>
                                <span>Tư vấn mua hàng miễn phí:</span>
                                <a href="tel:0975140100" class="text-primary hover">
                                    (+84) 976140100
                                </a>
                            </li>
                      </ul>
                  </div>
              </div>
              <!-- Header Top Left Area End Here -->
              <!-- Begin Header Top Right Area -->
              <div class="col-lg-9 col-md-8">
                  <div class="header-top-right">
                      <ul class="ht-menu">
                          <!-- Language Area End Here -->
                            <?php
                                $customer_id = Auth::guard('customer')->check();
                                $id = NULL;
                                $shipping_id = Session::get('shipping_id');
                                $name = NULL;
                                if ($customer_id)
                                    $name = Auth::guard('customer')->user()->customer_name
                            ?>
                            <?php
                                if ($customer_id)
                                    $id = Auth::guard('customer')->user()->customer_id
                            ?>

                            @if ($customer_id != null)
                            <li class="text-body">
                                <i class="fa fa-crosshairs text-danger" style="margin-right: 6px"></i>
                                <a href="{{ URL::to('checkout') }}" class="text-danger">Thanh toán</a>
                            </li>
                            @else
                            <li>
                                <i class="fa fa-crosshairs text-danger" style="margin-right: 6px"></i>
                                <a href="{{ URL::to('login-checkout') }}" class="text-danger">Thanh toán</a>
                            </li>
                            @endif

                            @if($customer_id != null && $name)
                            <li>
                                {{-- <span class="language-selector-wrapper"> --}}
                                    <i class="fa fa-lock text-danger" style="margin-right: 6px"></i>
                                    <a href="{{ route('customer.logout_customer') }}" class="text-danger">
                                        Đăng xuất
                                    </a>
                                {{-- </span> --}}
                            </li>

                            {{-- <li>
                                <a href="#">
                                    <i class="fa fa-user text-danger"></i>
                                    <span class="text-secondary">{{ $name }}</span>
                                </a>
                            </li> --}}
                            <li>
                                <span class="language-selector-wrapper"><i class="fa fa-user text-danger"></i> :</span>
                                <div class="ht-language-trigger"><span>{{ $name }}</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li>
                                            <a href="{{ route('customer.profile_customer', $id) }}">
                                                <i class="fa fa-user text-danger"></i>
                                                Tài khoản
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('manager_order', $id) }}">
                                                <i class="fa fa-shopping-cart text-danger"></i>
                                                Đơn mua
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @else
                            <li>
                                {{-- <span class="language-selector-wrapper"> --}}
                                    <i class="fa fa-lock text-danger" style="margin-right: 6px"></i>
                                    <a href="{{ URL::to('login-checkout') }}" class="text-danger">
                                        Đăng nhập
                                    </a>
                                {{-- </span> --}}
                            </li>
                            @endif
                      </ul>
                  </div>
              </div>
              <!-- Header Top Right Area End Here -->
          </div>
      </div>
  </div>
</header>