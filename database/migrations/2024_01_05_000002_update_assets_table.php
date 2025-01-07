<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('asset_name')->after('name');
            $table->string('serial_number')->nullable()->after('licence_id');
            $table->integer('quantity')->default(1)->after('serial_number');
        });
    }

    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['asset_name', 'serial_number', 'quantity']);
        });
    }
}; 