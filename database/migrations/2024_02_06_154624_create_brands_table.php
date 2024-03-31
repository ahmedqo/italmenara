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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name_en')->unique();
            $table->string('name_fr')->unique();
            $table->string('name_it')->unique();
            $table->string('name_ar')->unique();
            $table->string('description_en')->nullable();
            $table->string('description_fr')->nullable();
            $table->string('description_it')->nullable();
            $table->string('description_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
