<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductDetailRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\BrandProduct;
use App\Models\Category;
use App\Models\ItemType;
use App\Models\Product;
use App\Services\BrandProductService;
use App\Services\CategoryProductService;
use App\Services\ProductService;
use App\Services\TypeItemService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class ProductController extends Controller
{
    protected $productService;
    protected $typeItemService;
    protected $brandProductService;
    protected $categoryProductService;

    public function __construct(
        ProductService $productService,
        TypeItemService $typeItemService,
        BrandProductService $brandProductService,
        CategoryProductService $categoryProductService
        )
    {
        $this->productService = $productService;
        $this->typeItemService = $typeItemService;
        $this->brandProductService = $brandProductService;
        $this->categoryProductService = $categoryProductService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->getAll($request);

        return view('admin.Product.list-product', [
            'title1' => 'Danh sách sản phẩm | Limupa',
        ], compact('products'));
    }

    public function show($id)
    {
        $productDetail = $this->productService->show($id);
        if (isset($productDetail['success']) && $productDetail['success'] == false) {
            return redirect()->route('products.index')->with('error', $productDetail['message']);
        }
        return view('admin.Product.detail-product', [
            'title1' => 'Chi tiết sản phẩm | Limupa'
        ], compact('productDetail', 'id'));
    }

    public function create(Request $request)
    {
        $items = $this->typeItemService->getAll($request);
        $brands = $this->brandProductService->getAll($request);
        $categories = $this->categoryProductService->getAll($request);
        return view('admin.Product.create-product', [
            'title1' => 'Thêm sản phẩm | Limupa'
        ], compact('items', 'brands', 'categories'));
    }

    // function ajax gọi category cho view create product
    public function getCategory($idBrand)
    {
        $categories = $this->categoryProductService->getCategory($idBrand);
        foreach ($categories as $category) {
            echo " <option value='".$category->category_id."'>".$category->category_name."</option>";
        }
    }
    // function ajax gọi brand cho view create product
    public function getBand($idItem)
    {
        $brands = $this->brandProductService->getBand($idItem);
        foreach ($brands as $brand) {
            echo " <option value='".$brand->brand_id."'>".$brand->brand_name."</option>";
        }
    }

    public function store(CreateProductRequest $request)
    {
        $product = $this->productService->store($request);
        if (isset($product['success']) && $product['success'] == false) {
            return redirect()->route('products.index')->with('error', $product['message']);
        }

        if (isset($product['check']) && $product['check'] == true) {
            return redirect()->back()->with('error', 'Bạn chưa chọn mục này!');
        }

        if (isset($product['checkForNoDuplicates']) && $product['checkForNoDuplicates'] == true) {
            return redirect()->back()->with('error_1', 'Thể loại sản phẩm không thuộc thương hiệu sản phẩm!');
        }

        if (isset($product['ckeckFileImage']) && $product['ckeckFileImage'] == true) {
            return redirect()->back()->with('errorImage', 'Chỉ được chọn file jpg, png, jpeg');
        }

        if ($product) {
            return redirect()->route('products.index')->with('message', 'Thêm sản phẩm thành công!');
        } else {
            return redirect()->route('products.index')->with('error', 'Thêm sản phẩm thất bại');
        }
    }

    public function edit($id)
    {
        $product = $this->productService->edit($id);
        if (isset($product['success']) && $product['success'] == false) {
            return redirect()->route('products.index')->with('error', $product['message']);
        }

        return view('admin.Product.edit-product', [
            'title1' => 'Thêm sản phẩm | Limupa'
        ], compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->productService->update($request, $id);
        if (isset($product['success']) && $product['success'] == false) {
            return redirect()->route('products.index')->with('error', $product['message']);
        }

        if (isset($product['checkIssetName']) && $product['checkIssetName'] == true) {
            return redirect()->back()->with('errorName', $product['message']);
        }

        if (isset($product['ckeckFileImage']) && $product['ckeckFileImage'] == true) {
            return redirect()->back()->with('errorImage', 'Chỉ được chọn file jpg, png, jpeg');
        }

        if ($product) {
            return redirect()->route('products.index')->with('message', 'Update sản phẩm thành công!');
        } else {
            return redirect()->route('products.index')->with('error', 'Update sản phẩm thất bại');
        }
    }

    public function destroy($id)
    {
        $product = $this->productService->destroy($id);
        if (isset($product['success']) && $product['success'] == false) {
            return redirect()->route('products.index')->with('error', $product['message']);
        }
        if ($product) {
            return redirect()->route('products.index')->with('message', $product['message']);
        }
    }

    public function activeProduct($id)
    {
        $product = $this->productService->activeProduct($id);
        if (isset($product['success']) && $product['success'] == false) {
            return redirect()->route('products.index')->with('error', $product['message']);
        }
        if ($product) {
            return redirect()->route('products.index')->with('message',  $product['message']);
        }
    }

    public function unactiveProduct($id)
    {
        $product = $this->productService->unactiveProduct($id);
        if (isset($product['success']) && $product['success'] == false) {
            return redirect()->route('products.index')->with('error', $product['message']);
        }
        if ($product) {
            return redirect()->route('products.index')->with('message',  $product['message']);
        }
    }

    public function saveProductDetail(Request $request, $idDetailProduct)
    {
        $productDetail = $this->productService->saveProductDetail($request, $idDetailProduct);
        if ($productDetail) {
            return redirect()->back()->with('message', $productDetail['message']);
        } else {
            return redirect()->back()->with('message', "Thêm chi tiết sản phẩm thất bại!");
        }
    }

    public function updateProductDetail(Request $request, $idProduct)
    {
        $productDetail = $this->productService->updateProductDetail($request, $idProduct);
        if ($productDetail) {
            return redirect()->back()->with('message', $productDetail['message']);
        } else {
            return redirect()->back()->with('message', "Update chi tiết sản phẩm thất bại!");
        }
    }
}