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
        Schema::create('tasks_status', function (Blueprint $table) {
            $table->bigIncrements('taskstatus_id');
            $table->string('taskstatus_title', 100); // Status title
            $table->string('taskstatus_color', 20); // Color identifier
            $table->integer('taskstatus_position')->default(0); // Position for ordering
            $table->boolean('taskstatus_visible')->default(true); // Visibility status
            $table->timestamp('taskstatus_created')->useCurrent();
            $table->timestamp('taskstatus_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_status');
    }
};
