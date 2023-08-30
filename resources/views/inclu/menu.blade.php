<div class="header-bottom header-sticky d-none d-lg-block">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <!-- Begin Header Bottom Menu Area -->
              <div class="hb-menu hb-menu-2 d-xl-block">
                  <nav>
                      <ul>
                            <li class="dropdown-holder"><a href="/">Trang chủ</a></li>
                            <li class="megamenu-holder"><a href="show-product">Sản phẩm</a>
                                <ul class="megamenu hb-megamenu">
                                    @foreach ($item_type['data'] as $item)
                                        <li><a href="{{ URL::to('show-products-by-item/'.$item->item_id) }}">{{ $item->item_name }}</a>
                                            <ul>
                                                @foreach ($brand_product['data'] as $brand)
                                                    @if ($brand->item_id == $item->item_id)
                                                        <li><a href="{{ URL::to('show-products-by-brand/'.$brand->brand_id) }}">{{ $brand->brand_name }}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown-holder"><a href="#">Blog</a>
                                <ul class="hb-dropdown">
                                </ul>
                            </li>
                            <li class="catmenu-dropdown megamenu-static-holder"><a href="#">Maps</a></li>
                            <li><a href="#">Giới thiệu</a></li>
                            <!-- Begin Header Bottom Menu Information Area -->
                            <li class="hb-info f-right p-0 d-sm-none d-lg-block">
                                <span>107 Detech Towel II, Nguyễn Phong Sắc, Dịch Vọng Hậu, Cầu Giấy, Hà Nội</span>
                            </li>
                            <!-- Header Bottom Menu Information Area End Here -->
                      </ul>
                  </nav>
              </div>
              <!-- Header Bottom Menu Area End Here -->
          </div>
      </div>
  </div>
</div>