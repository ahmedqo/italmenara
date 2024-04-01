<?php

use App\Functions\Core;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('reference');
            $table->float('charges', 15, 5);
            $table->float('total', 15, 5);
            $table->enum('type', Core::invoiceTypeList());
            $table->text('note_en')->nullable();
            $table->text('note_fr')->nullable();
            $table->text('note_it')->nullable();
            $table->text('note_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
