<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const paymentMethodActiveStatus = 1;
    const paymentMethodUnactiveStatus = 0;
    const allStatus = 'all';
    const arrayStatus = [
        Payment::paymentMethodActiveStatus,
        Payment::paymentMethodUnactiveStatus,
    ];

    public $timestamps = false; // set time to false
    protected $fillable = ['payment_method', 'payment_decs', 'payment_status'];
    protected $primaryKey = 'payment_id';
    protected $table = 'tbl_payment';

    use HasFactory;
}
