<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\BrandProduct\BrandProductRepositoryInterface;
use App\Repositories\CategoryProduct\CategoryProductRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\TypeItem\TypeItemRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class ProductService
{
    protected $productRepository;
    protected $typeItemRepository;
    protected $brandProductRepository;
    protected $categoryProductRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        TypeItemRepositoryInterface $typeItemRepository,
        BrandProductRepositoryInterface $brandProductRepository,
        CategoryProductRepositoryInterface $categoryProductRepository
        )
    {
        $this->productRepository = $productRepository;
        $this->typeItemRepository = $typeItemRepository;
        $this->brandProductRepository = $brandProductRepository;
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function getAll($request)
    {
        DB::beginTransaction();
        try {
            $products = $this->productRepository->getAll($request);
            DB::commit();
            return [
                'status' => 200,
                'data' => $products
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function show($id)
    {
        $product = $this->edit($id);
        if (isset($product['success']) && $product['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $productDetails = $this->productRepository->show($id);
            DB::commit();
            return [
                'status' => 200,
                'data' => $productDetails
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function store($request)
    {
        $resultCheck = false;
        $resultCheckDuplicates = false;
        $ckeckFileImage = false;

        $item = $this->typeItemRepository->edit($request['item_id']);
        if (is_null($item)) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Loại sản phẩm không tồn tại!'
            ];
        }
        $brand = $this->brandProductRepository->edit($request['brand_id']);
        if (is_null($brand)) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thương hiệu sản phẩm không tồn tại!'
            ];
        }
        $category = $this->categoryProductRepository->edit($request['category_id']);
        if (is_null($category)) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thể loại sản phẩm không tồn tại!'
            ];
        }
        if (
            is_null($request['item_id'])
            ||
            is_null($request['brand_id'])
            ||
            is_null($request['category_id'])
        ) {
            $resultCheck = true;
            return [
                'status' => 200,
                'check' => $resultCheck
            ];
        }
        if ($category['brand_id'] != $request['brand_id']) {
            $resultCheckDuplicates = true;
            return [
                'status' => 200,
                'check' => $resultCheck,
                'checkForNoDuplicates' => $resultCheckDuplicates
            ];
        }
        $name_image = NULL;
        if ($request->hasFile('product_image')) {
            $get_image = $request->file('product_image'); // lấy file ảnh
            /**
             * Ta phải kiểm tra thêm xem file truyền vào có khác 3 đuôi
             * jpg, png, jpeg không
             */
            $fileExtension = $get_image->getClientOriginalExtension(); // lấy duôi file image
            if (
                $fileExtension != "jpg"
                &&
                $fileExtension != "png"
                &&
                $fileExtension != "jpeg"
            ) {
                $ckeckFileImage = true;
                return [
                    'status' => 200,
                    'check' => $resultCheck,
                    'checkForNoDuplicates' => $resultCheckDuplicates,
                    'ckeckFileImage' => $ckeckFileImage
                ];
            }
            $get_name_image = $get_image->getClientOriginalName(); // lấy name image
            $name_image = Str::random(4)."_".$get_name_image;
            while(file_exists("uploads/product/".$name_image)) {
                $name_image = Str::random(4)."_".$get_name_image;
            }
            $get_image->move("uploads/product",$name_image); // lưu fide ten hình
        }
        $day = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $today = [
            'today' => $day,
            'name_image' => $name_image
        ];
        DB::beginTransaction();
        try {
            $product = $this->productRepository->store($request, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $product,
                'check' => $resultCheck,
                'checkForNoDuplicates' => $resultCheckDuplicates,
                'ckeckFileImage' => $ckeckFileImage
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
            $product = $this->productRepository->edit($id);
            if (is_null($product)) {
                return [
                    'success' => false,
                    'error_subcode' => 400,
                    'message' => 'sản phẩm không tồn tại!'
                ];
            }
            DB::commit();
            return [
                'status' => 200,
                'data' => $product
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
        $product = $this->edit($id);
        if (isset($product['success']) && $product['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'sản phẩm không tồn tại!'
            ];
        }
        if ($request['item_id'] != $product['data']['item_id']) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Loại sản phẩm không tồn tại!'
            ];
        }
        if ($request['brand_id'] != $product['data']['brand_id']) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thương hiệu sản phẩm không tồn tại!'
            ];
        }
        if ($request['category_id'] != $product['data']['category_id']) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'Thể loại sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $resultCheck = false;
            $arrayNameProduct = $this->productRepository->getArrayNameProduct();
            $checkName = in_array($request['product_name'], $arrayNameProduct);
            if ($checkName && $request['product_name'] != $product['data']['product_name']) {
                $resultCheck = true;
                return [
                    'status' => 500,
                    'checkIssetName' => $resultCheck,
                    'message' => 'Sản phẩm này đã tồn tại!'
                ];
            }
            $name_image = NULL;
            $ckeckFileImage = false;
            if ($request->hasFile('product_image')) {
                $get_image = $request->file('product_image'); // lấy file ảnh
                /**
                 * Ta phải kiểm tra thêm xem file truyền vào có khác 3 đuôi
                 * jpg, png, jpeg không
                 */
                $fileExtension = $get_image->getClientOriginalExtension(); // lấy duôi file image
                if (
                    $fileExtension != "jpg"
                    &&
                    $fileExtension != "png"
                    &&
                    $fileExtension != "jpeg"
                ) {
                    $ckeckFileImage = true;
                    return [
                        'status' => 200,
                        'ckeckFileImage' => $ckeckFileImage
                    ];
                }
                $get_name_image = $get_image->getClientOriginalName(); // lấy name image
                $name_image = Str::random(4)."_".$get_name_image;
                while(file_exists("uploads/product/".$name_image)) {
                    $name_image = Str::random(4)."_".$get_name_image;
                }
                $get_image->move("uploads/product",$name_image); // lưu fide ten hình
                unlink("uploads/product/".$product['data']['product_image']); // xỏa bỏ hình cũ đi
            }
            $day = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $today = [
                'today' => $day,
                'name_image' => $name_image
            ];
            $product = $this->productRepository->update($request, $id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $product
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
        $product = $this->edit($id);
        if (isset($product['success']) && $product['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $product = $this->productRepository->destroy($id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $product,
                'message' => 'Xóa sản phẩm thành công!'
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
        $product = $this->edit($id);
        if (isset($product['success']))
            return $product;

        $productStatus = $product['data']['product_status'];
        DB::beginTransaction();
        try {
            $product = $this->productRepository->statusChange($id, $productStatus);
            DB::commit();
            return [
                'status' => 200,
                'status_after_change' => $product
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function saveProductDetail($request, $idProduct)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        DB::beginTransaction();
        try {
            $productDetails = $this->productRepository->saveProductDetail($request, $idProduct, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' =>  $productDetails,
                'message' => 'Thêm chi tiết sản phẩm thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => 'Thêm chi tiết sản phẩm thất bại!',
                'error' => $e->getMessage()
            ];
        }
    }

    public function updateProductDetail($request, $idDetailProduct)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        DB::beginTransaction();
        try {
            $productDetails = $this->productRepository->updateProductDetail($request, $idDetailProduct, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' =>  $productDetails,
                'message' => 'Chỉnh sửa chi tiết sản phẩm thành công!'
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}
