<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mock_test_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mock_test_id')
                ->constrained()
                ->onDelete('cascade');

            $table->text('question');

            $table->string('option_a')->nullable();
            $table->string('option_b')->nullable();
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();

            // ✅ ADD THIS
            $table->enum('correct_answer', ['a', 'b', 'c', 'd'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mock_test_questions');
    }
};
