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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();

            // ✅ ADD THIS (VERY IMPORTANT)
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('type');
            $table->string('location')->nullable();
            $table->string('department')->nullable();
            $table->integer('experience_min')->nullable();
            $table->integer('experience_max')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->longText('description')->nullable();
            $table->longText('requirements')->nullable();
            $table->boolean('has_test')->default(false);
            $table->enum('test_mode', ['strict', 'flexible'])->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
