<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    const activeStatus = 1;
    const unactiveStatus = 0;
    const allStatus = 'all';
    const arrayStatus = [
        BrandProduct::activeStatus,
        BrandProduct::unactiveStatus,
    ];

    public $timestamps = false; // set time to false
    protected $fillable = ['brand_name', 'brand_desc', 'brand_status'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';

    use HasFactory;
}
