<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  PaymentForSparesOrServices extends Model
{
    use HasFactory;
    protected $table = 'payment_for_spares_or_services';
    public $timestamps = false;
}
