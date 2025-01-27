<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->id('licence_id');
            $table->unsignedBigInteger('product_id');
            $table->string('licence_key');
            $table->date('expiration_date');
            $table->integer('cost');
            $table->string('status');
            $table->timestamps();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('licences');
    }
}; 