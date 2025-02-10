<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('component', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('min_quantity')->nullable();
            $table->bigInteger('serial');
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->string('model_no')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->bigInteger('order_number')->nullable();
            $table->date('purchase_date');
            $table->integer('purchase_cost')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component');
    }
};
