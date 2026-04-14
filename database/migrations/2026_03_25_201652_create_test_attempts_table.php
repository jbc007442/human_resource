<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mock_test_id')->constrained()->cascadeOnDelete();

            $table->integer('total_questions');
            $table->integer('correct_answers')->default(0);
            $table->float('score')->default(0); // %

            $table->integer('time_taken')->nullable();

            $table->timestamps();

            // 🚫 Prevent duplicate attempt (IMPORTANT)
            $table->unique(['user_id', 'mock_test_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
