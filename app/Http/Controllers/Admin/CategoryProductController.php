<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryProductRequest;
use App\Http\Requests\Category\UpdateCategoryProductRequest;
use App\Models\Category;
use App\Services\BrandProductService;
use App\Services\CategoryProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class CategoryProductController extends Controller
{
    protected $categoryProductService;
    protected $brandProductService;

    public function __construct(CategoryProductService $categoryProductService, BrandProductService $brandProductService)
    {
        $this->categoryProductService = $categoryProductService;
        $this->brandProductService = $brandProductService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryProductService->getAll($request);

        return view('admin.CategoryProduct.list-category-product', [
            'title1' => 'Thể loại sản phẩm | Limupa',
        ], compact('categories'));
    }

    public function create()
    {
        $brands = $this->brandProductService->getBrandFromCategory();

        return view('admin.CategoryProduct.create-category-product', [
            'title1' => 'Thêm thể loại sản phẩm | Limupa'
            ],
            compact('brands')
        );
    }

    public function store(CreateCategoryProductRequest $request)
    {
        $category = $this->categoryProductService->store($request->all());
        if (isset($category['success']) && $category['success'] == false) {
            return redirect()->route('categories.index')->with('error', $category['message']);
        }
        if ($category) {
            return redirect()->route('categories.index')->with('message', 'Thêm thể loại sản phẩm thành công!');
        }
    }

    public function edit($id)
    {
        $category = $this->categoryProductService->edit($id);
        if (isset($category['success']) && $category['success'] == false) {
            return redirect()->route('categories.index')->with('error', $category['message']);
        }
        return view(
            'admin.CategoryProduct.edit-category-product',
            [
                'title1' => 'Chỉnh sửa thể loại sản phẩm | Limupa',
            ],
            compact('category')
        );
    }

    public function update(UpdateCategoryProductRequest $request, $id)
    {
        // $check = $this->categoryProductService->checkCategory($request->all(), $id);
        // if (isset($id) && $check['data']['category_id'] != $id) {
        //     return redirect()->back()->with('message', 'Thể loại sản phẩm đã tồn tại!');
        // }
        $category = $this->categoryProductService->update($request, $id);
        if (isset($category['success']) && $category['success'] == false) {
            return redirect()->route('categories.index')->with('error', $category['message']);
        }
        if (isset($category['checkIssetName']) && $category['checkIssetName'] == true) {
            return redirect()->back()->with('errorName', $category ['message']);
        }
        if ($category) {
            return redirect()->route('categories.index')->with('message', 'update thể loại sản phẩm thành công!');
        }
    }

    public function destroy($id)
    {
        $category = $this->categoryProductService->destroy($id);
        if (isset($category['success']) && $category['success'] == false) {
            return redirect()->route('categories.index')->with('error', $category['message']);
        }
        if ($category) {
            return redirect()->route('categories.index')->with('message', 'Xóa thể loại sản phẩm thành công!');
        }
    }

    public function statusChange($id)
    {
        $category = $this->categoryProductService->statusChange($id);
        if (isset($category['success']) && $category['success'] == false) {
            return redirect()->route('categories.index')->with('error', $category['message']);
        }
        switch ($category['status_after_change']) {
            case Category::unactiveStatus:
                return redirect()->route('categories.index')->with('message', 'Tắt kích hoạt thể loại sản phẩm thành công!');
            case Category::activeStatus:
                return redirect()->route('categories.index')->with('message', 'Kích hoạt thể loại sản phẩm thành công!');
            default:
                return redirect()->route('categories.index');
        }
    }
}
