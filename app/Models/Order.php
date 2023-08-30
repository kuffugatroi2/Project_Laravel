<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const approvalPendingStatus = 1;
    const approvedStatus = 2;
    const rejectionStatus = 3;
    const transportStatus = 4;
    const returnGoodsStatus = 5;
    const allStatus = 'all';
    const arrayStatus = [
        Order::approvalPendingStatus,
        Order::approvedStatus,
        Order::rejectionStatus,
        Order::transportStatus,
        Order::returnGoodsStatus
    ];

    public $timestamps = false; // set time to false
    protected $fillable = ['customer_id', 'shipping_id', 'payment_id', 'tax', 'order_total', 'order_status'];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

    use HasFactory;
}
