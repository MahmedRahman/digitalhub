<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First get the column names from the existing table
        $columns = collect(DB::select('PRAGMA table_info(enrollments)'))->pluck('name')->toArray();
        $columnsList = implode(', ', $columns);
        
        // Create temp table with existing data
        DB::statement('CREATE TABLE enrollments_temp AS SELECT * FROM enrollments');
        
        // Drop original table
        Schema::dropIfExists('enrollments');
        
        // Recreate the table with new enum values
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('progress')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'course_id']);
        });
        
        // Copy data back using the exact columns
        DB::statement("INSERT INTO enrollments ($columnsList) SELECT $columnsList FROM enrollments_temp");
        
        // Drop temp table
        DB::statement('DROP TABLE enrollments_temp');
    }

    public function down(): void
    {
        // Get column names
        $columns = collect(DB::select('PRAGMA table_info(enrollments)'))->pluck('name')->toArray();
        $columnsList = implode(', ', $columns);
        
        // Create temp table
        DB::statement('CREATE TABLE enrollments_temp AS SELECT * FROM enrollments');
        
        // Drop original
        Schema::dropIfExists('enrollments');
        
        // Recreate with old enum values
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('progress')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'course_id']);
        });
        
        // Copy data back
        DB::statement("INSERT INTO enrollments ($columnsList) SELECT $columnsList FROM enrollments_temp");
        
        // Drop temp
        DB::statement('DROP TABLE enrollments_temp');
    }
};
