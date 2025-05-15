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
        Schema::create('tasks', function (Blueprint $table) {
        $table->id();    
        $table->string('title');
        $table->text('description');
        $table->enum('status', ['pending', 'accepted', 'in_progress', 'under_review', 'completed'])->default('pending');
        $table->date('due_date');
        $table->boolean('is_public')->default(false);
        $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
