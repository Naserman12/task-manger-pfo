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
        Schema::create('group_user', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('role', ['member', 'sub_leader'])->default('member');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->foreignId('invited_by')->constrained('users');
            $table->string('token')->unique()->nullable();
            $table->timestamp('invited_at')->useCurrent();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();
            $table->primary(['group_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {  Schema::table('group_user', function(Blueprint $table){
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
    });
        Schema::dropIfExists('group_user');
    }
};
