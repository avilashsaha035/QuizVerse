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
        Schema::create('answers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('exam_attempt_users_id')->constrained('exam_attempt_users')->onDelete('cascade');
                $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
                $table->foreignId('selected_option_id')->nullable()->constrained('options')->onDelete('set null');
                $table->boolean('is_correct')->default(false);
                $table->timestamp('answered_at')->nullable();
                $table->timestamps();

                $table->unique(['exam_attempt_users_id', 'question_id']); // one answer per question per attempt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
