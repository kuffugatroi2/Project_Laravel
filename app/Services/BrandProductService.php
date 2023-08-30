<?php

namespace App\Services;

// use App\Repositories\BrandProduct\BrandProductRepositoryInterface as BrandProductBrandProductRepositoryInterface;
use App\Repositories\BrandProduct\BrandProductRepositoryInterface;
use App\Repositories\TypeItem\TypeItemRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class BrandProductService
{
    protected $brandProductRepository;
    protected $typeItemRepositoryInterface;

    public function __construct(
        BrandProductRepositoryInterface $brandProductRepository,
        TypeItemRepositoryInterface $typeItemRepositoryInterface
        )
    {
        $this->brandProductRepository = $brandProductRepository;
        $this->typeItemRepositoryInterface = $typeItemRepositoryInterface;
    }

    public function getAll($request)
    {
        try {
            $brands = $this->brandProductRepository->getAll($request);
            return [
                'status' => 200,
                'data' => $brands
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function store($request)
    {
        $item = $this->typeItemRepositoryInterface->edit($request['item_id']);
        if (is_null($item)) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Loại sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $brand = $this->brandProductRepository->store($request, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $brand
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $brand = $this->brandProductRepository->edit($id);
            if (is_null($brand)) {
                return [
                    'success' => false,
                    'error_subcode' => 400,
                    'message' => 'Thương hiệu sản phẩm không tồn tại!'
                ];
            }
            DB::commit();
            return [
                'status' => 200,
                'data' => $brand
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function update($request, $id)
    {
        $resultCheck = false;
        $brand = $this->brandProductRepository->edit($id);
        if (is_null($brand)) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thương hiệu sản phẩm không tồn tại!'
            ];
        }
        if ($request['item_id'] != $brand['item_id']) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Loại sản phẩm không tồn tại!'
            ];
        }
        $arrayNameBrandProduct = $this->brandProductRepository->getArrayNameProduct();
        $checkName = in_array($request['brand_product_name'], $arrayNameBrandProduct);
        if ($checkName && $request['brand_product_name'] != $brand['brand_name']) {
            $resultCheck = true;
            return [
                'status' => 500,
                'checkIssetName' => $resultCheck,
                'message' => 'Sản phẩm này đã tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $brand = $this->brandProductRepository->update($request, $id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $brand
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        $brand = $this->brandProductRepository->edit($id);
        if (is_null($brand)) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thương hiệu sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $brand = $this->brandProductRepository->destroy($id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $brand
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function statusChange($id)
    {
        $brand = $this->edit($id);
        $brandStatus = $brand['data']['brand_status'];
        if (isset($item['success']) && $item['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $brand = $this->brandProductRepository->statusChange($id, $brandStatus);
            DB::commit();
            return [
                'status' => 200,
                'status_after_change' => $brand
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getBand($idItem)
    {
        return $this->brandProductRepository->getBand($idItem);
    }

    public function getBrandFromCategory()
    {
        try {
            $brands = $this->brandProductRepository->getBrandFromCategory();
            return [
                'status' => 200,
                'data' => $brands
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}
