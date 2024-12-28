<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id('id');  
            $table->string('product');
            $table->string('status');  
            $table->string('asset_name');
            $table->string('serial')->unique();
            $table->integer('quantity');
            $table->string('assigned_user');
            $table->text('pdf')->nullable();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
