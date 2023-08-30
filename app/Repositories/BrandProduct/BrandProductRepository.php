<?php

namespace App\Repositories\BrandProduct;

use App\Models\BrandProduct;

class BrandProductRepository implements BrandProductRepositoryInterface
{
    public function getModel()
    {
        return BrandProduct::class;
    }

    public function getAll($request)
    {
        $brands = BrandProduct::whereNull('deleted_at');
        if (
            isset($request['select-status'])
            &&
            in_array($request['select-status'], BrandProduct::arrayStatus)
        ) {
            $brands->where('brand_status', $request['select-status']);
        } elseif (
            isset($request['select-status'])
            &&
            !in_array($request['select-status'], BrandProduct::arrayStatus)
            &&
            strcmp ( $request['select-status'] , BrandProduct::allStatus ) != 0
        ) {
            $brands = [];
            return $brands;
        }
        $keyword = $request['search-name-brand'];
        if (isset($request['search-name-brand']) && !is_null($request['search-name-brand'])) {
            $brands->where('brand_name','like','%'.$keyword.'%' );
        }
        $brands = $brands->paginate(8);
        return $brands;
    }

    public function store($request, $today)
    {
        $brand = new BrandProduct();
        $brand->item_id = $request['item_id'];
        $brand->brand_name = $request['brand_product_name'];
        // $brand->meta_keywords = $request['meta_keywords_brand'];
        $brand->brand_status = BrandProduct::activeStatus;
        $brand->created_at = $today;
        $brand->save();
        return $brand;
    }

    public function edit($id)
    {
        $brand = BrandProduct::where('brand_id', $id)
                ->join('tbl_item_type', 'tbl_item_type.item_id', '=' ,'tbl_brand.item_id')
                ->whereNull('tbl_brand.deleted_at')
                ->first();
        return $brand;
    }
    public function update($request, $id, $today)
    {
        $brand = BrandProduct::find($id);
        $brand->item_id = $request['item_id'];
        $brand->brand_name = $request['brand_product_name'];
        // $brand->meta_keywords = $request['meta_keywords_brand'];
        $brand->brand_status = BrandProduct::activeStatus;
        $brand->updated_at = $today;
        $brand->save();
        return $brand;
    }
    public function destroy($id, $today)
    {
        $brand = BrandProduct::whereNull('deleted_at')->findOrFail($id);
        $brand->deleted_at = $today;
        $brand->save();
        return $brand;
    }

    public function statusChange($id, $brandStatus)
    {
        if ($brandStatus == BrandProduct::unactiveStatus) {
            BrandProduct::where('brand_id', $id)->update(['brand_status' => BrandProduct::activeStatus]);
        } else {
            BrandProduct::where('brand_id', $id)->update(['brand_status' => BrandProduct::unactiveStatus]);
        }
        $brand = $this->edit($id);
        return $brand['item_status'];
    }

    public function getArrayNameProduct()
    {
        return BrandProduct::whereNull('deleted_at')->pluck('brand_name')->toArray();
    }

    public function getBand($idItem)
    {
        return BrandProduct::where('item_id', $idItem)->whereNull('deleted_at')->get();
    }

    public function getBrandFromCategory()
    {
        return BrandProduct::whereNull('deleted_at')->get();
    }
}
