@extends('admin_layout')
@section('admin_content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="product-area pt-35 col-lg-12">
                    @if ($productDetail['data'] == NULL)
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="li-product-tab">
                                    <ul class="nav li-product-menu">
                                       <li><a class="active btn btn-primary" data-toggle="tab" href="#description"><span>Product Details</span></a></li>
                                       <li><a class="btn btn-primary" data-toggle="tab" href="#product-details"><span>Content</span></a></li>
                                       <li><a class="btn btn-primary" data-toggle="tab" href="#create-product-details"><span>Thêm mới</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="description" class="tab-pane active show" role="tabpanel">
                                  <div class="product-description">
                                      <table class="table table-hover table-light">
                                          <tr>
                                              <td>CPU:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>RAM:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Ổ cứng:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Màn hình:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Card màn hình:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Cổng kết nối:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Đặc biệt:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Hệ điều hành:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Thiết kế:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Kích thước, khối lượng:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                          <tr>
                                              <td>Thời điểm ra mắt:</td>
                                              <td class="text-info">NULL</td>
                                          </tr>
                                      </table>
                                  </div>
                            </div>
                            <div id="product-details" class="tab-pane" role="tabpanel">
                                <div class="product-details-manufacturer">
                                    <p style="text-align: center;">Mô tả</p><hr>
                                    <p><span></span></p>
                                    <br>
                                    <p style="text-align: center;">Nội dung </p><hr>
                                    <p><span></span></p>
                                </div>
                            </div>
                            <div id="create-product-details" class="tab-pane" role="tabpanel">
                                <div class="product-details-manufacturer">
                                    <div class="card">
                                        <form role="form" action="{{ route('products.product_detail', $id) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="card-header">
                                                <strong>Thêm chi tiết sản phẩm</strong> FORM
                                            </div>
                                                <div class="card-body card-block">
                                                    <div class="form-group">
                                                        <label>Mô tả</label>
                                                        <textarea rows="8" name="product_description" class="form-control ckeditor" placeholder="Mô tả sản phẩm ..."></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nội dung</label>
                                                        <textarea rows="8" name="product_content" class="form-control ckeditor" placeholder="Nội dung sản phẩm ..."></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">CPU</label>
                                                            <input type="text" id="product_cpu" name="product_cpu" placeholder="Nhập CPU sản phẩm" class="form-control">
                                                            @error('product_cpu')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">RAM</label>
                                                            <input type="text" id="product_ram" name="product_ram" placeholder="Nhập RAM sản phẩm" class="form-control">
                                                            @error('product_ram')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Ổ cứng</label>
                                                            <input type="text" id="product_hard_drive" name="product_hard_drive" placeholder="Nhập ổ cứng sản phẩm" class="form-control">
                                                            @error('product_hard_drive')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Màn hình</label>
                                                            <input type="text" id="product_screen" name="product_screen" placeholder="Nhập màn hình sản phẩm" class="form-control">
                                                            @error('product_screen')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Cổng kết nối</label>
                                                            <input type="text" id="product_connection" name="product_connection" placeholder="Nhập cổng kết nối sản phẩm" class="form-control">
                                                            @error('product_connection')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Card màn hình</label>
                                                            <input type="text" id="product_card_screen" name="product_card_screen" placeholder="Nhập card màn hình sản phẩm" class="form-control">
                                                            @error('product_card_screen')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Đặc biệt</label>
                                                            <input type="text" id="product_especially" name="product_especially" placeholder="Nhập đặc biệt của sản phẩm" class="form-control">
                                                            @error('product_especially')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Hệ điều hành</label>
                                                            <input type="text" id="product_operating_system" name="product_operating_system" placeholder="Nhập hệ điều hành sản phẩm" class="form-control">
                                                            @error('product_operating_system')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Thiết kế</label>
                                                            <input type="text" id="product_design" name="product_design" placeholder="Nhập Thiết kê sản phẩm" class="form-control">
                                                            @error('product_design')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Kích thước, khối lượng</label>
                                                            <input type="text" id="product_size_mass" name="product_size_mass" placeholder="Nhập kích thước, khối lượng sản phẩm" class="form-control">
                                                            @error('product_size_mass')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Thời điểm ra mắt</label>
                                                            <input type="text" id="product_release_time" name="product_release_time" placeholder="Nhập thời điểm ra mắt sản phẩm" class="form-control">
                                                            @error('product_release_time')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Thêm mới
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i> Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                    $message = Session::get('message');
                                    if ($message) {
                                        echo '<div class="alert alert-success">'.$message.'</div>';
                                        Session::put('message', null);
                                    }
                                ?>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{session('error')}}
                                    </div>
                                @endif
                                <div class="li-product-tab">
                                    <ul class="nav li-product-menu">
                                       <li><a class="active btn btn-primary" data-toggle="tab" href="#description"><span>Product Details</span></a></li>
                                       <li><a class="btn btn-primary" data-toggle="tab" href="#product-details"><span>Content</span></a></li>
                                       <li><a class="btn btn-primary" data-toggle="tab" href="#update-product-details"><span>Chỉnh sửa</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="description" class="tab-pane active show" role="tabpanel">
                                  <div class="product-description">
                                      <table class="table table-hover table-light">
                                          <tr>
                                              <td>CPU:</td>
                                              <td class="text-info">{{ $productDetail['data']->cpu }}</td>
                                          </tr>
                                          <tr>
                                              <td>RAM:</td>
                                              <td class="text-info">{{ $productDetail['data']->ram }}</td>
                                          </tr>
                                          <tr>
                                              <td>Ổ cứng:</td>
                                              <td class="text-info">{{ $productDetail['data']->hard_drive }}</td>
                                          </tr>
                                          <tr>
                                              <td>Màn hình:</td>
                                              <td class="text-info">{{ $productDetail['data']->screen }}</td>
                                          </tr>
                                          <tr>
                                              <td>Card màn hình:</td>
                                              <td class="text-info">{{ $productDetail['data']->card_screen }}</td>
                                          </tr>
                                          <tr>
                                              <td>Cổng kết nối:</td>
                                              <td class="text-info">{{ $productDetail['data']->connection }}</td>
                                          </tr>
                                          <tr>
                                              <td>Đặc biệt:</td>
                                              <td class="text-info">{{ $productDetail['data']->especially }}</td>
                                          </tr>
                                          <tr>
                                              <td>Hệ điều hành:</td>
                                              <td class="text-info">{{ $productDetail['data']->operating_system }}</td>
                                          </tr>
                                          <tr>
                                              <td>Thiết kế:</td>
                                              <td class="text-info">{{ $productDetail['data']->design }}</td>
                                          </tr>
                                          <tr>
                                              <td>Kích thước, khối lượng:</td>
                                              <td class="text-info">{{ $productDetail['data']->size_mass }}</td>
                                          </tr>
                                          <tr>
                                              <td>Thời điểm ra mắt:</td>
                                              <td class="text-info">{{ $productDetail['data']->release_time }}</td>
                                          </tr>
                                      </table>
                                  </div>
                            </div>
                            <div id="product-details" class="tab-pane" role="tabpanel">
                                <div class="product-details-manufacturer">
                                    <p style="text-align: center;">Mô tả</p><hr>
                                    <p><span>{{  $productDetail['data']->desc }}</span></p>
                                    <br>
                                    <p style="text-align: center;">Nội dung </p><hr>
                                    <p><span>{{  $productDetail['data']->content }}</span></p>
                                </div>
                            </div>
                            <div id="update-product-details" class="tab-pane" role="tabpanel">
                                <div class="product-details-manufacturer">
                                    <div class="card">
                                        <form role="form" action="{{ route('products.update_product_detail', $productDetail['data']->product_detail_id) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="card-header">
                                                <strong>Update chi tiết sản phẩm</strong> FORM
                                            </div>
                                                <div class="card-body card-block">
                                                    <div class="form-group">
                                                        <label>Mô tả</label>
                                                        <textarea rows="8" name="product_description" class="form-control ckeditor" placeholder="Mô tả sản phẩm ...">{{ $productDetail['data']->desc }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nội dung</label>
                                                        <textarea rows="8" name="product_content" class="form-control ckeditor" placeholder="Nội dung sản phẩm ...">{{ $productDetail['data']->content }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">CPU</label>
                                                            <input type="text" id="product_cpu" name="product_cpu" placeholder="Nhập CPU sản phẩm" class="form-control" value="{{ $productDetail['data']->cpu }}">
                                                            @error('product_cpu')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">RAM</label>
                                                            <input type="text" id="product_ram" name="product_ram" placeholder="Nhập RAM sản phẩm" class="form-control" value="{{ $productDetail['data']->ram }}">
                                                            @error('product_ram')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Ổ cứng</label>
                                                            <input type="text" id="product_hard_drive" name="product_hard_drive" placeholder="Nhập ổ cứng sản phẩm" class="form-control" value="{{ $productDetail['data']->hard_drive }}">
                                                            @error('product_hard_drive')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Màn hình</label>
                                                            <input type="text" id="product_screen" name="product_screen" placeholder="Nhập màn hình sản phẩm" class="form-control" value="{{ $productDetail['data']->screen }}">
                                                            @error('product_screen')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Cổng kết nối</label>
                                                            <input type="text" id="product_connection" name="product_connection" placeholder="Nhập cổng kết nối sản phẩm" class="form-control" value="{{ $productDetail['data']->connection }}">
                                                            @error('product_connection')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Card màn hình</label>
                                                            <input type="text" id="product_card_screen" name="product_card_screen" placeholder="Nhập card màn hình sản phẩm" class="form-control" value="{{ $productDetail['data']->card_screen }}">
                                                            @error('product_card_screen')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Đặc biệt</label>
                                                            <input type="text" id="product_especially" name="product_especially" placeholder="Nhập đặc biệt của sản phẩm" class="form-control" value="{{ $productDetail['data']->especially }}">
                                                            @error('product_especially')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Hệ điều hành</label>
                                                            <input type="text" id="product_operating_system" name="product_operating_system" placeholder="Nhập hệ điều hành sản phẩm" class="form-control" value="{{ $productDetail['data']->operating_system }}">
                                                            @error('product_operating_system')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Thiết kế</label>
                                                            <input type="text" id="product_design" name="product_design" placeholder="Nhập Thiết kê sản phẩm" class="form-control" value="{{ $productDetail['data']->design }}">
                                                            @error('product_design')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Kích thước, khối lượng</label>
                                                            <input type="text" id="product_size_mass" name="product_size_mass" placeholder="Nhập kích thước, khối lượng sản phẩm" class="form-control" value="{{ $productDetail['data']->size_mass }}">
                                                            @error('product_size_mass')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class=" form-control-label">Thời điểm ra mắt</label>
                                                            <input type="text" id="product_release_time" name="product_release_time" placeholder="Nhập thời điểm ra mắt sản phẩm" class="form-control" value="{{ $productDetail['data']->release_time }}">
                                                            @error('product_release_time')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Chỉnh sửa
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i> Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection