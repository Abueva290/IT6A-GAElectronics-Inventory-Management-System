<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade');
            $table->date('payment_date');
            $table->decimal('amount_paid', 12, 2);
            $table->enum('payment_method', ['cash','gcash','paymaya','bank_transfer','other']);
            $table->enum('status', ['paid','partial','unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('payments');
    }
};