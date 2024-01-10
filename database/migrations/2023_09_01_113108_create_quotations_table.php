<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('hsn_code')->nullable();
            $table->string('product_code')->nullable();
            $table->text('material_description')->nullable();
            $table->decimal('quantity')->nullable();
            $table->string('uom')->nullable();
            $table->double('list_price')->nullable();
            $table->double('discount')->nullable();
            $table->double('unit_cost_in_inr')->nullable();
            $table->double('factor')->nullable();
            $table->double('unit_price_in_inr')->nullable();
            $table->double('total_cost_in_inr')->nullable();
            $table->double('total_price_in_inr')->nullable();
            $table->double('profit')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('purchase_quotes_files')->nullable();
            $table->string('our_reference')->nullable();
            $table->text('quotation_note')->nullable();
            $table->string('commercial_terms_gst')->nullable();
            $table->string('payment_spares_or_service')->nullable();
            $table->string('delivery_parts_service')->nullable();
            $table->string('delivery_terms')->nullable();
            $table->text('commercial_terms_note')->nullable();
            $table->text('purchase_quotes_files_note')->nullable();
            $table->enum('status', [1, 2, 3, 4])->default(2)->comment('1=create, 2=open, 3=won, 4=lost');
            $table->integer('quotation_detail_id')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
