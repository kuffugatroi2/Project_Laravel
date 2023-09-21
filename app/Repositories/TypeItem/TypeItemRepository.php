<?php

namespace App\Repositories\TypeItem;

use App\Models\ItemType;

class TypeItemRepository implements TypeItemRepositoryInterface
{
    public function getModel()
    {
        return ItemType::class;
    }

    public function getAll($request)
    {
        $items = ItemType::whereNull('deleted_at');
        if (
            isset($request['select-status'])
            &&
            in_array($request['select-status'], ItemType::arrayStatus)
        ) {
            $items->where('item_status', $request['select-status']);
        } elseif (
            isset($request['select-status'])
            &&
            !in_array($request['select-status'], ItemType::arrayStatus)
            &&
            strcmp ( $request['select-status'] , ItemType::allStatus ) != 0
        ) {
            $items = [];
            return $items;
        }
        $keyword = $request['search-name-item'];
        if (isset($request['search-name-item']) && !is_null($request['search-name-item'])) {
            $items->where('item_name','like','%'.$keyword.'%' );
        }
        $items = $items->get();
        return $items;
    }

    public function store($request, $today)
    {
        $item = new ItemType();
        $item->item_name = $request['item_name'];
        $item->item_status = 1;
        $item->created_at = $today;
        $item->save();
        return $item;
    }

    public function edit($id)
    {
        return ItemType::whereNull('deleted_at')->find($id);
    }
    public function update($request, $id, $today)
    {
        $item = ItemType::find($id);
        $item->item_name = $request['item_name'];
        $item->updated_at = $today;
        $item->save();
        return $item;
    }
    public function destroy($id, $today)
    {
        $item = ItemType::findOrFail($id);
        $item->deleted_at = $today;
        $item->save();
        return $item;
    }

    public function statusChange($id, $itemStatus)
    {
        $itemStatus = $itemStatus === ItemType::activeStatus ? ItemType::unactiveStatus : ItemType::activeStatus;
        ItemType::where('item_id', $id)->update(['item_status' => $itemStatus]);
        $item = $this->edit($id);
        return $item['item_status'];
    }
}
