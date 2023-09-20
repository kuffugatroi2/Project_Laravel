<?php

namespace App\Services;

use App\Repositories\TypeItem\TypeItemRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class TypeItemService
{
    protected $typeItemRepository;

    public function __construct(TypeItemRepositoryInterface $typeItemRepository)
    {
        $this->typeItemRepository = $typeItemRepository;
    }

    public function getAll($request)
    {
        // if (!in_array($request['select-status'], ItemType::arrayStatus)) {
            // return [
            //     'success' => false,
            //     'error_subcode' => 400,
            //     'message' => 'Trạng thái không tồn tại!'
            // ];
        // }
        try {
            $items = $this->typeItemRepository->getAll($request);
            // if ($items['check'] == false) {
            //     return [
            //         'data' => $items['items'],
            //         'success' => false,
            //         'error_subcode' => 400,
            //         'message' => 'Trạng thái không tồn tại!'
            //     ];
            // }
            return [
                'status' => 200,
                'data' => $items
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
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $item = $this->typeItemRepository->store($request, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $item
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
            $item = $this->typeItemRepository->edit($id);
            if (is_null($item)) {
                return [
                    'success' => false,
                    'error_subcode' => 400,
                    'message' => 'loại sản phẩm không tồn tại!'
                ];
            }
            DB::commit();
            return [
                'status' => 200,
                'data' => $item
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
        $item = $this->edit($id);
        if (isset($item['success']) && $item['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $item = $this->typeItemRepository->update($request, $id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $item
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
        $item = $this->edit($id);
        if (isset($item['success']) && $item['success'] == false) {
            return [
                'success' => false,
                'error_subcode' => 400,
                'message' => 'sản phẩm không tồn tại!'
            ];
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $item = $this->typeItemRepository->destroy($id, $today);
            DB::commit();
            return [
                'status' => 200,
                'data' => $item
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
        $item = $this->edit($id);
        if (isset($item['success']))
            return $item;

        $itemStatus = $item['data']['item_status'];
        DB::beginTransaction();
        try {
            $item = $this->typeItemRepository->statusChange($id, $itemStatus);
            DB::commit();
            return [
                'status' => 200,
                'success' => true,
                'status_after_change' => $item
            ];
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
