<?php

namespace App\Services;

use App\Repositories\BrandProduct\BrandProductRepositoryInterface;
use App\Repositories\CategoryProduct\CategoryProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class CategoryProductService
{
    protected $categoryProductRepository;
    protected $brandProductRepository;

    public function __construct(
        CategoryProductRepositoryInterface $categoryProductRepository,
        BrandProductRepositoryInterface $brandProductRepository
        )
    {
        $this->categoryProductRepository = $categoryProductRepository;
        $this->brandProductRepository = $brandProductRepository;
    }

    public function getAll($request)
    {
        try {
            $categories['data'] = $this->categoryProductRepository->getAll($request);
            return [
                'status' => 200,
                'data' => $categories['data']
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
        $brand = $this->brandProductRepository->edit($request['brand_id']);
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
            $category = $this->categoryProductRepository->store($request, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $category
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
            $category = $this->categoryProductRepository->edit($id);
            if (is_null($category)) {
                return [
                    'success' => false,
                    'error_subcode' => 400,
                    'message' => 'Thể loại sản phẩm không tồn tại!'
                ];
            }
            DB::commit();
            return [
                'status' => 200,
                'data' => $category
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
        $category = $this->edit($id);
        if (isset($category['success']) && $category['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thể loại sản phẩm không tồn tại!'
            ];
        }
        if ($request['brand_id'] != $category['data']['brand_id']) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thương hiệu sản phẩm không tồn tại!'
            ];
        }
        $arrayNameCategoryProduct = $this->categoryProductRepository->getArrayNameCategoryProduct();
        $checkName = in_array($request['category_product_name'], $arrayNameCategoryProduct);
        if ($checkName && $request['category_product_name'] != $category['data']['category_name']) {
            $resultCheck = true;
            return [
                'status' => 500,
                'checkIssetName' => $resultCheck,
                'message' => 'Thể loại sản phẩm này đã tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $category = $this->categoryProductRepository->update($request, $id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $category
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
        $category = $this->edit($id);
        if (isset($category['success']) && $category['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thể loại sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $category = $this->categoryProductRepository->destroy($id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $category
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
        $category = $this->edit($id);
        if (isset($category['success']))
            return $category;

        $categoryStatus = $category['data']['category_status'];
        DB::beginTransaction();
        try {
            $category = $this->categoryProductRepository->statusChange($id, $categoryStatus);
            DB::commit();
            return [
                'status' => 200,
                'status_after_change' => $category
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function checkCategory($request)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryProductRepository->checkCategory($request);
            DB::commit();
            return [
                'status' => 200,
                'data' => $category
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getCategory($idBrand)
    {
        $categories = $this->categoryProductRepository->getCategory($idBrand);
        return $categories;
    }
}
