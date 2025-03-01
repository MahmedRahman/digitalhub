<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remove the instructor_id column from courses table
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['instructor_id']);
            $table->dropColumn('instructor_id');
        });
    }

    public function down(): void
    {
        // Add back the instructor_id column
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('instructor_id')->constrained('instructors')->onDelete('cascade');
        });
    }
};
