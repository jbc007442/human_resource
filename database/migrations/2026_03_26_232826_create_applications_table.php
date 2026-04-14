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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('job_id')->constrained('job_posts')->cascadeOnDelete();
            $table->foreignId('resume_id')->constrained()->cascadeOnDelete();

            // 📊 Test Score (MCQ)
            $table->integer('score')->nullable();

            // 🤖 ATS Score (Overall)
            $table->integer('ats_score')->nullable();

            // 🔍 Breakdown (no JSON)
            $table->integer('ats_skill_score')->nullable();
            $table->integer('ats_experience_score')->nullable();
            $table->integer('ats_education_score')->nullable();

            // 💬 Feedback
            $table->text('ats_feedback')->nullable();

            // 📌 Status
            $table->enum('status', ['pending', 'shortlisted', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
