<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('live_course_rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livecourse_id')->constrained('livecourses')->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained('instructors')->onDelete('cascade');
            $table->string('round_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('hours_count');
            $table->decimal('price', 10, 2);
            $table->text('notes')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('live_course_rounds');
    }
};
