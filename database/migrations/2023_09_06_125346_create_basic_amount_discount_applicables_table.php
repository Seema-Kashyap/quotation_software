<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicAmountDiscountApplicablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_amount_discount_applicables', function (Blueprint $table) {
            $table->id();
            $table->double('discount_basic_amount')->nullable();
            $table->double('gst_applicable')->nullable();
            $table->tinyInteger('is_gst')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_amount_discount_applicables');
    }
}
