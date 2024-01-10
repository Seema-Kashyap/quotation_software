<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  BasicAmountDiscountApplicables extends Model
{
    use HasFactory;

    protected $table = 'basic_amount_discount_applicables';
    public $timestamps = false;
}
