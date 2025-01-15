<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('live_course_round_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('cash'); // cash, bank_transfer, etc.
            $table->string('reference_number')->nullable(); // رقم مرجعي للدفعة
            $table->string('receipt_number')->unique(); // رقم الفاتورة
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // لتسريع عمليات البحث
            $table->index(['live_course_round_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_payments');
    }
};
