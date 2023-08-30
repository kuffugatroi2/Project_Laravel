<?php

namespace App\Repositories\CategoryProduct;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryProductRepository implements CategoryProductRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getAll($request)
    {
        $categories = Category::leftjoin('tbl_brand', 'tbl_category_product.brand_id', '=', 'tbl_brand.brand_id')
                    ->select('tbl_category_product.*','tbl_brand.brand_name')
                    ->whereNull('tbl_category_product.deleted_at');
        if (
            isset($request['select-status'])
            &&
            in_array($request['select-status'], Category::arrayStatus)
        ) {
            $categories->where('tbl_category_product.category_status', $request['select-status']);
        } elseif (
            isset($request['select-status'])
            &&
            !in_array($request['select-status'], Category::arrayStatus)
            &&
            strcmp ( $request['select-status'] , Category::allStatus ) != 0
        ) {
            $categories = [];
            return $categories;
        }
        $keyword = $request['search-name-category'];
        if (isset($request['search-name-category']) && !is_null($request['search-name-category'])) {
            $categories->where('tbl_category_product.category_name','like','%'.$keyword.'%' );
        }
        $categories = $categories->paginate(8);
        return $categories;
    }

    public function store($request, $today)
    {
        $category = new Category();
        $category->brand_id = $request['brand_id'];
        $category->category_name = $request['category_product_name'];
        // $category->meta_keywords = $request['meta_keywords_category_product'];
        $category->category_status = Category::activeStatus;
        $category->created_at = $today;
        $category->save();
        return $category;
    }

    public function edit($id)
    {
        $category = Category::join('tbl_brand', 'tbl_category_product.brand_id', '=' ,'tbl_brand.brand_id')
        ->select('tbl_category_product.*','tbl_brand.brand_name')
        ->whereNull('tbl_category_product.deleted_at')
        ->find($id);
        return $category;
    }
    public function update($request, $id, $today)
    {
        $category = Category::find($id);
        $category->brand_id = $request['brand_id'];
        $category->category_name = $request['category_product_name'];
        // $category->meta_keywords = $request['meta_keywords_category_product'];
        $category->updated_at = $today;
        $category->save();
        return $category;
    }
    public function destroy($id, $today)
    {
        $category = Category::whereNull('deleted_at')->findOrFail($id);
        $category->deleted_at = $today;
        $category->save();
        return $category;
    }

    public function activeCategory($id)
    {
        $category = Category::where('category_id', $id)->update(['category_status' => Category::activeStatus]);
        return $category;
    }

    public function unactiveCategory($id)
    {
        $category = Category::where('category_id', $id)->update(['category_status' => Category::unactiveStatus]);
        return $category;
    }

    public function checkCategory($request)
    {
        $check = Category::where('category_name', request()->category_product_name)->first();
        return $check;
    }

    public function getCategory($idBrand)
    {
        return Category::where('brand_id', $idBrand)->whereNull('deleted_at')->get();
    }

    public function getArrayNameCategoryProduct()
    {
        return Category::whereNull('deleted_at')->pluck('category_name')->toArray();
    }
}