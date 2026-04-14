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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();

            // RELATION WITH RESUME
            $table->foreignId('resume_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            // ACHIEVEMENT DETAILS
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // OPTIONAL: ordering
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
