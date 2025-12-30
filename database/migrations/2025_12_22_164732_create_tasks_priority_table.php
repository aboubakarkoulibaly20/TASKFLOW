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
        Schema::create('tasks_priority', function (Blueprint $table) {
            $table->bigIncrements('taskpriority_id');
            $table->string('taskpriority_title', 50); // Priority title
            $table->string('taskpriority_color', 20); // Color identifier
            $table->integer('taskpriority_position')->default(0); // Position for ordering
            $table->boolean('taskpriority_visible')->default(true); // Visibility status
            $table->timestamp('taskpriority_created')->useCurrent();
            $table->timestamp('taskpriority_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_priority');
    }
};
