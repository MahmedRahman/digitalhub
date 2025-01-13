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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content')->nullable(); // المحتوى النصي للدرس
            $table->string('video_url')->nullable(); // رابط الفيديو
            $table->string('video_duration')->nullable(); // مدة الفيديو
            $table->integer('order')->default(0); // ترتيب الدرس في الكورس
            $table->boolean('is_free')->default(false); // هل الدرس مجاني؟
            $table->boolean('is_published')->default(false); // هل الدرس منشور؟
            $table->text('resources')->nullable(); // موارد إضافية للدرس (JSON)
            $table->text('attachments')->nullable(); // مرفقات الدرس (JSON)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
