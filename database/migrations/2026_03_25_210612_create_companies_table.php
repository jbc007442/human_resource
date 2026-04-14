<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // 🔗 User Relation
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 🟢 Basic Info
            $table->string('company_name');
            $table->string('ceo')->nullable();
            $table->text('about')->nullable();
            $table->string('logo')->nullable();

            // 🟢 Company Details
            $table->year('founded')->nullable();
            $table->string('size')->nullable();
            $table->string('industry')->nullable();
            $table->string('revenue')->nullable();
            $table->string('hq')->nullable();
            $table->string('website')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
