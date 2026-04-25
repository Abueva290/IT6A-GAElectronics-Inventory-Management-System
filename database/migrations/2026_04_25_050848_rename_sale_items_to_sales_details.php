<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::rename('sale_items', 'sales_details');
    }
    public function down(): void {
        Schema::rename('sales_details', 'sale_items');
    }
};