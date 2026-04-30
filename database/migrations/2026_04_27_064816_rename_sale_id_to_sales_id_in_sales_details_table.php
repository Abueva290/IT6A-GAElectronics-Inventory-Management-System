<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sales_details', function (Blueprint $table) {
            $table->renameColumn('sale_id', 'sales_id');
        });
    }

    public function down()
    {
        Schema::table('sales_details', function (Blueprint $table) {
            $table->renameColumn('sales_id', 'sale_id');
        });
    }
};  