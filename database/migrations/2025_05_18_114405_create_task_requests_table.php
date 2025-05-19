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
        Schema::create('task_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // العضو الذي طلب تنفيذ المهمة

            $table->enum('status', [
                'pending',  // قيد الانتظار (الطلب جديد)
                'approved', // تم قبول الطلب (عضو مكلف رسميًا)
                'rejected'  // تم رفض الطلب
            ])->default('pending');

            $table->text('note')->nullable(); // ملاحظة أو سبب الرفض/القبول (اختياري)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_requests');
    }
};
