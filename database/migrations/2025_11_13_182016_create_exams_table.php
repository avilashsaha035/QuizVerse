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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('exam_type'); // BCS, Bank, IELTS, Varsity
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->nullOnDelete();
            $table->json('subject_wise_questions')->nullable();
            $table->integer('duration_minutes');
            $table->integer('no_of_ques')->nullable();
            $table->boolean('is_shuffling')->default(false);
            $table->integer('pass_marks')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('language')->default('en');
            $table->string('access_code')->nullable();
            $table->unsignedInteger('attempts_allowed')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            // indexes
            $table->index(['exam_type', 'is_active']);
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
