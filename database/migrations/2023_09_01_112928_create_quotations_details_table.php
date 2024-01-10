<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations_details', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('our_reference')->nullable();
            $table->text('quotation_note')->nullable();
            $table->string('quotations_gst')->nullable();
            $table->string('commercial_terms_gst')->nullable();
            $table->string('payment_spares_or_service')->nullable();
            $table->string('delivery_parts_service')->nullable();
            $table->string('delivery_terms')->nullable();
            $table->string('commercial_terms_note')->nullable();
            $table->string('purchase_quotes_files_note')->nullable();
            $table->integer('purchase_quotes_files_note_id')->nullable();
            $table->double('quotation_descount_basic_amount')->nullable();
            $table->integer('quotations_table_id')->nullable();
            $table->enum('status', [1, 2, 3, 4])->default(2)->comment('1=create, 2=open, 3=won, 4=lost');
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
        Schema::dropIfExists('quotations_details');
    }
}
