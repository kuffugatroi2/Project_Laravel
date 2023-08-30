<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const activeStatus = 1;
    const unactiveStatus = 0;
    const allStatus = 'all';
    const arrayStatus = [
        Category::activeStatus,
        Category::unactiveStatus,
    ];

    public $timestamps = false; // set time to false
    protected $fillable = ['category_name', 'category_desc', 'category_status', 'meta_keywords'];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    // public function product() {
    //     return $this->belongsTo('');
    // }

    use HasFactory;
}
