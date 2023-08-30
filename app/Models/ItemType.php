<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    const activeStatus = 1;
    const unactiveStatus = 0;
    const allStatus = 'all';
    const arrayStatus = [
        ItemType::activeStatus,
        ItemType::unactiveStatus,
    ];

    public $timestamps = true;
    protected $fillable = ['item_name', 'item_status', 'deleted_at'];
    protected $primaryKey = 'item_id';
    protected $table = 'tbl_item_type';

    use HasFactory;
}
