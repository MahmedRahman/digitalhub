<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('round_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('live_course_round_id')->constrained('live_course_rounds')->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('remaining_amount', 10, 2)->storedAs('total_price - paid_amount');
            $table->enum('payment_status', ['pending', 'partial', 'completed'])->default('pending');
            $table->enum('enrollment_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Prevent duplicate enrollments
            $table->unique(['user_id', 'live_course_round_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('round_enrollments');
    }
};
