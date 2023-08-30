<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false; // set time to false
    protected $fillable = ['name', 'type', 'matp'];
    protected $primaryKey = 'maqh';
    protected $table = 'tbl_quanhuyen';

    use HasFactory;

    public function city() {
        return $this->belongsTo('App\Models\City', 'matp', 'maqh');
    }

    public function wards() {
        return $this->hasMany('App\Models\Wards', 'maqh', 'xaid');
    }
}
