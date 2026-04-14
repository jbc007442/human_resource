<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_benefits', function (Blueprint $table) {
            $table->id();

            // 🔗 Company relation
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_benefits');
    }
};
