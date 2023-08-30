<?php

namespace App\Repositories\Home;

use App\Models\BrandProduct;
use App\Models\Category;
use App\Models\ItemType;
use App\Models\Product;
use PhpParser\Node\Expr\FuncCall;

class HomeRepository implements HomeRepositoryInterface
{
    public function getModel()
    {
        return BrandProduct::class;
    }

    public function getAllItem()
    {
        $item_type = ItemType::where('item_status', '1')
                ->whereNull('deleted_at')
                ->get();
        return $item_type;
    }

    public function getAllBrand()
    {
        $brand_product = BrandProduct::where('brand_status', '1')
                        ->orderBy('brand_id','desc')
                        ->get();
        return $brand_product;
    }

    public function getAllCategory()
    {
        $cate_product = Category::where('category_status', '1')
                        ->orderBy('category_id','desc')
                        ->get();
        return $cate_product;
    }

    public function getAllProduct()
    {
        $all_product = Product::orderBy('product_id', 'desc')->paginate(8);
        return $all_product;
    }

    public function getAllProductByItem($item_id)
    {
        $all_product_by_item = Product::where('item_id', $item_id)
                        ->whereNull('deleted_at')
                        ->where('product_status', 1)
                        ->orderBy('product_id', 'desc')
                        ->paginate(8);
        return $all_product_by_item;
    }

    public function getAllProductByBrand($brand_id)
    {
        $all_product_by_brand = Product::where('brand_id', $brand_id)
                            ->whereNull('deleted_at')
                            ->where('product_status', 1)
                            ->orderBy('product_id', 'desc')
                            ->paginate(8);
        return $all_product_by_brand;
    }

    public function getAllProductByCategory($category_id)
    {
        $all_product_by_category = Product::where('category_id', $category_id)
                            ->whereNull('deleted_at')
                            ->where('product_status', 1)
                            ->orderBy('product_id', 'desc')
                            ->paginate(8);
        return $all_product_by_category;
    }

    public function getAllLaptop()
    {
        return Product::where('item_id', '1')
                ->whereNull('deleted_at')
                ->where('product_status', 1)
                ->orderBy('product_id','desc')
                ->limit(6)->get();
    }

    public function getDetailLaptop($product_id)
    {
        $details = Product::join('tbl_category_product', 'tbl_category_product.category_id','=','tbl_product.category_id')
                    ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
                    ->leftjoin('tbl_product_detail', 'tbl_product_detail.product_id', '=', 'tbl_product.product_id')
                    ->where('tbl_product.product_id', $product_id)
                    ->first();

        $orther_same_product = Product::where('category_id', $details['category_id'])
                                ->whereNotIn('tbl_product.product_id',[$product_id])
                                ->get();

        return [
            'details' => $details,
            'ortherSame' => $orther_same_product
        ];
    }

    public function search($keywords)
    {
        $search_product = Product::where('product_name','like','%'.$keywords.'%')
                            ->orderBy('product_id', 'desc')
                            ->paginate(6);
        return $search_product;
    }

    public function getAllSmartphone()
    {
        return Product::where('item_id', '2')
            ->orderBy('product_id','desc')
            ->limit(6)->get();
    }

    public function getAllHeadphone()
    {
        return Product::where('item_id', '7')
            ->orderBy('product_id','desc')
            ->limit(6)->get();
    }
}