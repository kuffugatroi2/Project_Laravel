<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        {{-- <a href="admin/dashboard"> --}}
        {{-- <a class="active" href="{{ route('dashboard') }}">
            <img src="be/images/icon/logo.png" alt="Cool Admin" />
        </a> --}}
        <a href="{{ route('dashboard') }}">
            <img src="frontend/images/menu/logo/1.jpg" alt="">
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="{{ route('dashboard') }}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <i class="fas fa-home text-primary"></i>
                            </div>
                            <div class="form-group col-md-10">
                                Trang chủ
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('items.index') }}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <i class="fas fa-clipboard-list text-primary"></i>
                            </div>
                            <div class="form-group col-md-10">
                                Loại sản phẩm
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('brands.index') }}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <img src="https://cdn-icons-png.flaticon.com/512/882/882726.png" alt="" style="width: 18px; height: 16px;">
                            </div>
                            <div class="form-group col-md-10">
                                Thương hiệu sản phẩm
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <i class="fa fa-list-alt text-primary"></i>
                            </div>
                            <div class="form-group col-md-10">
                                Thể loại sản phẩm
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <i class="fas fa-mobile-alt text-primary"></i>
                            </div>
                            <div class="form-group col-md-10">
                                Sản phẩm
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('payments.index') }}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <i class="fa fa-euro text-primary"></i>
                            </div>
                            <div class="form-group col-md-10">
                                Thanh toán
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('order.manager_order')}}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <i class="fas fa-motorcycle text-primary"></i>
                            </div>
                            <div class="form-group col-md-10">
                                Quản lý đơn hàng
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.get_list_customer')}}">
                        <div class="row margin-bottom">
                            <div class="form-group col-md-2">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                            <div class="form-group col-md-10">
                                Quản lý khách hàng
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>