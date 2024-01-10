<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationsDetail extends Model
{
    use HasFactory;

    protected $table = 'quotations_details';

    public $timestamps = false;
}
