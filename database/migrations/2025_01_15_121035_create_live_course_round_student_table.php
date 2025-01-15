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
        Schema::create('live_course_round_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('live_course_round_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->timestamps();

            // Prevent duplicate enrollments
            $table->unique(['live_course_round_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_course_round_student');
    }
};
