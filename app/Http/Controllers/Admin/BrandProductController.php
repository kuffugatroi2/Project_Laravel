<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandProductRequest;
use App\Http\Requests\Brand\UpdateBrandProductRequest;
use App\Models\Brand;
use App\Models\BrandProduct;
use App\Services\BrandProductService;
use App\Services\TypeItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProductController extends Controller
{
    protected $brandProductService;
    protected $typeItemService;

    public function __construct(BrandProductService $brandProductService, TypeItemService $typeItemService)
    {
        $this->brandProductService = $brandProductService;
        $this->typeItemService = $typeItemService;
    }

    public function index(Request $request)
    {
        $brands = $this->brandProductService->getAll($request);
        return view(
            'admin.BrandProduct.list_brand_product',
            [
                'title1' => 'Danh sách thương hiệu sản phẩm | Limupa',
                'title2' => 'Danh sách thương hiệu sản phẩm'
            ],
            compact('brands')
        );
    }

    public function create(Request $request)
    {
        $allItem = $this->typeItemService->getAll($request);
        return view(
            'admin.BrandProduct.create_brand_product',
            [
                'title1' => 'Thêm thương hiệu sản phẩm mới| Limupa',
                'title2' => 'Thêm thương hiệu sản phẩm mới'
            ],
            compact('allItem')
        );
    }

    public function store(BrandProductRequest $request)
    {
        $brand = $this->brandProductService->store($request->all());
        if (isset($brand['success']) && $brand['success'] == false) {
            return redirect()->route('brands.index')->with('error', $brand['message']);
        }
        if ($brand) {
            return redirect()->route('brands.index')->with('message', 'Thêm thương hiệu sản phẩm thành công!');
        }
    }

    public function edit(Request $request, $id)
    {
        $allItem = $this->typeItemService->getAll($request);
        $brand = $this->brandProductService->edit($id);
        if (isset($brand['success']) && $brand['success'] == false) {
            return redirect()->route('brands.index')->with('error', $brand['message']);
        }
        return view(
            'admin.BrandProduct.edit_brand_product',
            [
                'title1' => 'Chỉnh sửa thương hiệu sản phẩm | Limupa',
                'title2' => 'Chỉnh sửa thương hiệu sản phẩm'
            ],
            compact('brand', 'allItem')
        );
    }

    public function update(UpdateBrandProductRequest $request, $id)
    {
        $brand = $this->brandProductService->update($request->all(), $id);
        if (isset($brand['success']) && $brand['success'] == false) {
            return redirect()->route('brands.index')->with('error', $brand['message']);
        }
        if (isset($brand['checkIssetName']) && $brand['checkIssetName'] == true) {
            return redirect()->back()->with('errorName', $brand ['message']);
        }
        if ($brand) {
            return redirect()->route('brands.index')->with('message', 'update thương hiệu sản phẩm thành công!');
        }
    }

    public function destroy($id)
    {
        $brand = $this->brandProductService->destroy($id);
        if (isset($brand['success']) && $brand['success'] == false) {
            return redirect()->route('brands.index')->with('error', $brand['message']);
        }
        if ($brand) {
            return redirect()->route('brands.index')->with('message', 'Xóa thương hiệu sản phẩm thành công!');
        }
    }

    public function statusChange($id)
    {
        $brand = $this->brandProductService->statusChange($id);
        if (isset($brand['success']) && $brand['success'] == false) {
            return redirect()->route('brands.index')->with('error', $brand['message']);
        }
        switch ($brand['status_after_change']) {
            case BrandProduct::unactiveStatus:
                return redirect()->route('brands.index')->with('message', 'Tắt kích hoạt thương hiệu sản phẩm thành công!');
            case BrandProduct::activeStatus:
                return redirect()->route('brands.index')->with('message', 'Kích hoạt thương hiệu sản phẩm thành công!');
            default:
                return redirect()->route('brands.index');
        }
    }
}
