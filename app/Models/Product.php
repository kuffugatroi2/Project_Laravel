<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // const productWorkingStatus = 1;
    // const productInoperabilityStatus = 2;
    const activeStatus = 1;
    const unactiveStatus = 0;
    const allStatus = 'all';
    const arrayStatus = [
        Product::activeStatus,
        Product::unactiveStatus,
    ];

    public $timestamps = false; // set time to false
    protected $fillable =
    [
        'category_id',
        'brand_id',
        'item_id',
        'product_name',
        'product_price',
        'product_old_price',
        'product_quantity',
        'product_image',
        'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    use HasFactory;
}
