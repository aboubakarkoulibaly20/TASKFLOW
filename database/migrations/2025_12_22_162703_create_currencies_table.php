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
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('currency_id');
            $table->string('currency_code', 10)->unique(); // USD, EUR, etc.
            $table->string('currency_name', 100); // US Dollar, Euro, etc.
            $table->string('currency_symbol', 10); // $, €, etc.
            $table->boolean('currency_active')->default(true);
            $table->decimal('currency_rate', 10, 6)->default(1.000000); // Exchange rate
            $table->timestamp('currency_created')->useCurrent();
            $table->timestamp('currency_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
