<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Repositories\Home\HomeRepository;
use App\Repositories\Home\HomeRepositoryInterface;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Whoops\Run;

session_start();

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $cate_product = $this->homeService->getAllCategory();
        $all_laptop = $this->homeService->getAllLaptop();
        $allSmartphone = $this->homeService->getAllSmartphone();
        $allHeadphone = $this->homeService->getAllHeadphone();

        return view(
            'pages.home',
            [
                'title' => 'Limupa - Cửa hàng bán lẻ Laptop uy tín'
            ],
            compact('brand_product', 'cate_product', 'item_type', 'all_laptop', 'allSmartphone', 'allHeadphone')
        );
    }

    public function show_product()
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $all_product = $this->homeService->getAllProduct();

        return view(
            'pages.product.show',
            [
                'title' => 'Limupa - Laptop uy tín, mua bán giá tốt nhất tại Hà Nội'
            ],
            compact('item_type', 'brand_product', 'all_product')
        );
    }

    public function show_products_by_item($item_id)
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $all_product = $this->homeService->getAllProductByItem($item_id);

        return view(
            'pages.product.show',
            [
                'title' => 'Limupa - Laptop uy tín, mua bán giá tốt nhất tại Hà Nội'
            ],
            compact('item_type', 'brand_product', 'all_product')
        );
    }

    public function show_products_by_brand($brand_id)
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $all_product = $this->homeService->getAllProductByBrand($brand_id);

        return view(
            'pages.product.show',
            [
                'title' => 'Limupa - Laptop uy tín, mua bán giá tốt nhất tại Hà Nội'
            ],
            compact('item_type', 'brand_product', 'all_product')
        );
    }

    public function show_products_by_category($category_id)
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $all_product = $this->homeService->getAllProductByCategory($category_id);

        return view(
            'pages.product.show',
            [
                'title' => 'Limupa - Laptop uy tín, mua bán giá tốt nhất tại Hà Nội'
            ],
            compact('item_type', 'brand_product', 'all_product')
        );
    }

    public function details_product($product_id)
    {
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $details = $this->homeService->getDetailLaptop($product_id);
        $nameProduct = $details['data']['details']['product_name'];
        return view(
            'pages.product.show_details',
            [
                'title' => $nameProduct
            ],
            compact('item_type', 'brand_product', 'details')
        );
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;
        $item_type = $this->homeService->getAllItem();
        $brand_product = $this->homeService->getAllBrand();
        $all_product = $this->homeService->search($keywords);

        return view(
            'pages.product.show',
            [
                'title' => 'Limupa - Laptop uy tín, mua bán giá tốt nhất tại Hà Nội'
            ],
            compact('item_type', 'brand_product', 'all_product')
        );
    }
}
