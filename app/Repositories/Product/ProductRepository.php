<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductDetails;

class ProductRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getAll($request)
    {
        $products = Product::leftjoin('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
                    ->select('tbl_product.*','tbl_category_product.category_name')
                    ->whereNull('tbl_product.deleted_at');
        if (
            isset($request['select-status'])
            &&
            in_array($request['select-status'], Product::arrayStatus)
        ) {
            $products->where('tbl_product.product_status', $request['select-status']);
        } elseif (
            isset($request['select-status'])
            &&
            !in_array($request['select-status'], Product::arrayStatus)
            &&
            strcmp ( $request['select-status'] , Product::allStatus ) != 0
        ) {
            $products = [];
            return $products;
        }
        $keyword = $request['search-name-product'];
        if (isset($request['search-name-product']) && !is_null($request['search-name-product'])) {
            $products->where('tbl_product.product_name','like','%'.$keyword.'%' );
        }
        $products = $products->paginate(8);
        return $products;
    }

    public function show($id)
    {
        return ProductDetails::where('product_id', $id)->first();
    }

    public function store($request, $today)
    {
        $product = new Product();
        $product->item_id = $request['item_id'];
        $product->brand_id = $request['brand_id'];
        $product->category_id = $request['category_id'];
        $product->product_name = $request['product_name'];
        $product->product_price = $request['product_price'];
        $product->product_quantity = $request['product_quantity'];
        $product->product_old_price = $request['product_old_price'];
        $product->product_status = Product::activeStatus;
        $product->created_at = $today['today'];
        $product->product_image = $today['name_image'];
        $product->meta_keywords = $request['meta_keywords_product'];
        $product->save();
        return $product;
    }

    public function edit($id)
    {
        $product = Product::join('tbl_category_product', 'tbl_product.category_id', '=' ,'tbl_category_product.category_id')
                ->join('tbl_brand', 'tbl_product.brand_id', '=' ,'tbl_brand.brand_id')
                ->join('tbl_item_type', 'tbl_product.item_id', '=' ,'tbl_item_type.item_id')
                ->select('tbl_product.*','tbl_category_product.category_name', 'tbl_brand.brand_name', 'tbl_item_type.item_name')
                ->whereNull('tbl_product.deleted_at')
                ->find($id);
        return $product;
    }

    public function getArrayNameProduct()
    {
        return Product::whereNull('deleted_at')->pluck('product_name')->toArray();
    }

    public function update($request, $id, $today)
    {
        $product = Product::find($id);
        $product->item_id = $request['item_id'];
        $product->brand_id = $request['brand_id'];
        $product->category_id = $request['category_id'];
        $product->product_name = $request['product_name'];
        $product->product_price = $request['product_price'];
        $product->product_quantity = $request['product_quantity'];
        $product->product_old_price = $request['product_old_price'];
        $product->product_status = Product::activeStatus;
        $product->updated_at = $today['today'];
        $product->meta_keywords = $request['meta_keywords_product'];
        if (!is_null($today['name_image'])) {
            $product->product_image = $today['name_image'];
        }
        $product->save();
        return $product;
    }

    public function destroy($id, $today)
    {
        $product = Product::findOrFail($id);
        $product->deleted_at = $today;
        $product->save();
        return $product;
    }

    public function activeProduct($id)
    {
        return Product::where('product_id', $id)->update(['product_status' => Product::activeStatus]);
    }

    public function unactiveProduct($id)
    {
        return Product::where('product_id', $id)->update(['product_status' => Product::unactiveStatus]);
    }

    public function saveProductDetail($request, $idProduct, $today)
    {
        $productDetails = new ProductDetails();
        $productDetails->product_id = $idProduct;
        $productDetails->desc = $request['product_description'];
        $productDetails->content = $request['product_content'];
        $productDetails->cpu = $request['product_cpu'];
        $productDetails->ram = $request['product_ram'];
        $productDetails->hard_drive = $request['product_hard_drive'];
        $productDetails->screen = $request['product_screen'];
        $productDetails->card_screen = $request['product_card_screen'];
        $productDetails->connection = $request['product_connection'];
        $productDetails->especially = $request['product_especially'];
        $productDetails->operating_system = $request['product_operating_system'];
        $productDetails->design = $request['product_design'];
        $productDetails->size_mass = $request['product_size_mass'];
        $productDetails->release_time = $request['product_release_time'];
        $productDetails->created_at = $today;
        $productDetails->save();
        return $productDetails;
    }

    public function updateProductDetail($request, $idDetailProduct, $today)
    {
        $productDetails = ProductDetails::find($idDetailProduct);
        $productDetails->desc = $request['product_description'];
        $productDetails->content = $request['product_content'];
        $productDetails->cpu = $request['product_cpu'];
        $productDetails->ram = $request['product_ram'];
        $productDetails->hard_drive = $request['product_hard_drive'];
        $productDetails->screen = $request['product_screen'];
        $productDetails->card_screen = $request['product_card_screen'];
        $productDetails->connection = $request['product_connection'];
        $productDetails->especially = $request['product_especially'];
        $productDetails->operating_system = $request['product_operating_system'];
        $productDetails->design = $request['product_design'];
        $productDetails->size_mass = $request['product_size_mass'];
        $productDetails->release_time = $request['product_release_time'];
        $productDetails->updated_at = $today;
        $productDetails->save();
        return $productDetails;
    }
}