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
        Schema::create('tickets_status', function (Blueprint $table) {
            $table->bigIncrements('ticketstatus_id');
            $table->string('ticketstatus_title', 100); // Status title
            $table->string('ticketstatus_color', 20); // Color identifier
            $table->integer('ticketstatus_position')->default(0); // Position for ordering
            $table->boolean('ticketstatus_visible')->default(true); // Visibility status
            $table->timestamp('ticketstatus_created')->useCurrent();
            $table->timestamp('ticketstatus_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_status');
    }
};
