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
        Schema::create('leads_status', function (Blueprint $table) {
            $table->bigIncrements('leadstatus_id');
            $table->string('leadstatus_title', 100); // Status title
            $table->string('leadstatus_color', 20); // Color identifier
            $table->integer('leadstatus_position')->default(0); // Position for ordering
            $table->boolean('leadstatus_visible')->default(true); // Visibility status
            $table->timestamp('leadstatus_created')->useCurrent();
            $table->timestamp('leadstatus_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_status');
    }
};
