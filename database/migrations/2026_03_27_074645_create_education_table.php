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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resume_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            // MATCH YOUR BLADE
            $table->string('degree')->nullable();
            $table->string('institute')->nullable();
            $table->year('from')->nullable();
            $table->year('to')->nullable();
            $table->text('description')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
