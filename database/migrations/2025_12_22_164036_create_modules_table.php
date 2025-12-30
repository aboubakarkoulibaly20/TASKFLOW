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
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('module_id');
            $table->string('module_name', 100)->unique(); // Module name
            $table->string('module_status', 20)->default('enabled'); // 'enabled' or 'disabled'
            $table->text('module_description')->nullable(); // Optional description
            $table->string('module_category', 50)->nullable(); // Module category
            $table->integer('module_position')->default(0); // Position for ordering
            $table->timestamp('module_created')->useCurrent();
            $table->timestamp('module_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
