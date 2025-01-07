<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('assets');

        Schema::create('assets', function (Blueprint $table) {
            $table->id('asset_id');
            $table->string('asset_name');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('licence_id');
            $table->string('serial_number')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('status')->default('active');
            $table->string('assigned_to')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->onDelete('cascade');

            $table->foreign('licence_id')
                  ->references('licence_id')
                  ->on('licences')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
}; 