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
        Schema::table('live_course_round_student', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->default(0)->after('payment_status');
            $table->decimal('paid_amount', 10, 2)->default(0)->after('total_amount');
            $table->decimal('remaining_amount', 10, 2)->default(0)->after('paid_amount');
            $table->text('payment_notes')->nullable()->after('remaining_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('live_course_round_student', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'paid_amount', 'remaining_amount', 'payment_notes']);
        });
    }
};
