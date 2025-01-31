<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('product_name');
            $table->date('support_expire_date');
            $table->date('purchase_date');
            $table->integer('cost');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}; 