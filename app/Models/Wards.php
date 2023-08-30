<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false; // set time to false
    protected $fillable = ['name', 'type', 'maqh'];
    protected $primaryKey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';

    use HasFactory;

    public function district() {
        return $this->belongsTo('App\Models\District', 'maqh', 'xaid');
    }
}
