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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('task_id')->constrained();
            $table->foreignId('user_id')->constrained();
             $table->unsignedTinyInteger('rating')->nullable(); // تقييم من 1 إلى 5 (اختياري)

            $table->enum('type', [
                'general',   // تعليق عادي
                'completed', // تقييم بعد إكمال
                'rejected'   // ملاحظة عند الرفض
            ])->default('general');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
