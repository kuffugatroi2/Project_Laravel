<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    public $timestamps = false; // set time to false
    protected $fillable =
    [
        'product_id',
        'desc',
        'content',
        'cpu',
        'ram',
        'hard_drive',
        'screen',
        'card_screen',
        'connection',
        'especially',
        'operating_system',
        'design',
        'size_mass',
        'release_time'
    ];
    protected $primaryKey = 'product_detail_id';
    protected $table = 'tbl_product_detail';

    use HasFactory;
}
