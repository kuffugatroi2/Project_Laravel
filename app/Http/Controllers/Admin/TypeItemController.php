<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeItemRequest;
use App\Models\ItemType;
use App\Services\TypeItemService;
use Illuminate\Http\Request;

session_start();

class TypeItemController extends Controller
{
    protected $typeItemService;

    public function __construct(TypeItemService $typeItemService)
    {
        $this->typeItemService = $typeItemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->typeItemService->getAll($request);
        return view(
            'admin.TypeItem.list_type_item',
            [
                'title1' => 'Danh sách loại sản phẩm | Limupa',
                'title2' => 'Danh sách loại sản phẩm'
            ],
            compact('items')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'admin.TypeItem.create_type_item',
            [
                'title1' => 'Thêm Loại sản phẩm mới | Limupa',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeItemRequest $request)
    {
        $item = $this->typeItemService->store($request->all());
        if ($item) {
            // $request->session()->flash('message', "Thêm loại sản phẩm thành công!");
            // return redirect()->route('item.index');
            return redirect()->route('items.index')->with('message', 'Thêm loại sản phẩm thành công!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->typeItemService->edit($id);
        if (isset($item['success']) && $item['success'] == false) {
            return redirect()->route('items.index')->with('error', $item['message']);
        }
        return view(
            'admin.TypeItem.edit_type_item',
            [
                'title1' => 'Chỉnh sửa Loại sản phẩm | Limupa',
            ],
            compact('item')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeItemRequest $request, $id)
    {
        $item = $this->typeItemService->update($request->all(), $id);
        if (isset($item['success']) && $item['success'] == false) {
            return redirect()->route('items.index')->with('error', $item['message']);
        }
        if ($item) {
            // $request->session()->flash('message', "update loại sản phẩm thành công!");
            // return redirect()->route('item.index');
            return redirect()->route('items.index')->with('message', 'update loại sản phẩm thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {
        $item = ItemType::findOrFail($id);
        $item->delete();
        return redirect()->route('item.index')->with('message', 'Xóa loại sản phẩm thành công!');
    }
    */

    public function destroy($id)
    {
        $item = $this->typeItemService->destroy($id);
        if (isset($item['success']) && $item['success'] == false) {
            return redirect()->route('items.index')->with('error', $item['message']);
        }
        if ($item) {
            return redirect()->route('items.index')->with('message', 'Xóa loại sản phẩm thành công!');
        }
    }

    public function statusChange($id)
    {
        $item = $this->typeItemService->statusChange($id);
        if (isset($item['success']) && $item['success'] == false) {
            return redirect()->route('items.index')->with('error', $item['message']);
        }
        if ($item['status'] == 200 && $item['status_after_change'] == ItemType::unactiveStatus) {
            return redirect()->route('items.index')->with('message', 'Tắt kích hoạt loại sản phẩm thành công!');
        } else if ($item['status'] == 200 && $item['status_after_change'] == ItemType::activeStatus) {
            return redirect()->route('items.index')->with('message', 'kích hoạt loại sản phẩm thành công!');
        }
    }

    public function name($id)
    {
        return "benben";
    }
}
