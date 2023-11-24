<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Order;
use Carbon\Carbon;

class ManagerOrderWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $filters = array_filter($this->config) ?? [];
        // dd($filters);
        $allOrder = Order::join('tbl_customers', 'tbl_order.customer_id','=','tbl_customers.customer_id')
                ->select('tbl_order.*', 'tbl_customers.customer_name');
        // kiểm tra status
        if (
            isset($filters['select-status'])
            &&
            in_array($filters['select-status'], Order::arrayStatus)
        ) {
            $allOrder->where('tbl_order.order_status', $filters['select-status']);
        } elseif (
            isset($filters['select-status'])
            &&
            !in_array($filters['select-status'], Order::arrayStatus)
            &&
            strcmp ( $filters['select-status'] , Order::allStatus ) != 0
        ) {
            $allOrder = [];
            return view('admin.ManagerOrder.manager-order', [
                'title1' => 'Danh sách đơn hàng',
                'title2' => 'Liệt kê danh sách đơn hàng'
            ], compact('allOrder'));
        }
        // kiểm tra tên khách hàng
        $keyword = $filters['search-name-customer'] ?? '';
        if (isset($filters['search-name-customer']) && !is_null($filters['search-name-customer'])) {
            $allOrder->where('tbl_customers.customer_name','like','%'.$keyword.'%' );
        }
        // kiểm tra ngày muốn tìm kiếm
        $day = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $fromDate = isset($filters['from-date']) ? $filters['from-date'] : $day;
        $toDate = isset($filters['to-date']) ? $filters['to-date'] : $day;

        if (isset($filters['from-date']) || isset($filters['to-date']) || isset($filters['tab'])) {
            if (isset($filters['tab'])) {
                // 1 weeks
                $fromDate = strtotime ( '-7 day' , strtotime ( $fromDate ) ) ;
                $fromDate = date ( 'Y-m-j' , $fromDate );
                $toDate = strtotime ( '+1 day' , strtotime ( $toDate ) ) ;
                $toDate = date ( 'Y-m-j' , $toDate );
                goto query;
            }
            if (!empty($filters['to-date']) && empty($filters['from-date'])) {
                // Từ start month -> To-date
                $fromDate = Carbon::createFromFormat('Y-m-d', $day)->startOfMonth()->format('Y-m-d');
                $toDate = strtotime ( '+1 day' , strtotime ( $toDate ) ) ;
                $toDate = date ( 'Y-m-j' , $toDate );
            } else {
                /*
                    từ from-date -> today
                    từ from-date -> to-date
                */
                $toDate = strtotime ( '+1 day' , strtotime ( $toDate ) ) ;
                $toDate = date ( 'Y-m-j' , $toDate );
            }
            query:
            $allOrder->whereBetween('tbl_order.created_at', [$fromDate, $toDate]);
        }
        $allOrder = $allOrder->orderby('tbl_order.order_id','desc')->paginate(10);

        return view('widgets.manager_order_widget', compact('allOrder'));
    }
}
