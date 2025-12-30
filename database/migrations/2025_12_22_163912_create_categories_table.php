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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->string('category_name', 100); // Category name
            $table->string('category_type', 50); // 'project', 'lead', 'client', etc.
            $table->text('category_description')->nullable(); // Optional description
            $table->bigInteger('category_creatorid')->unsigned()->nullable(); // Creator user ID
            $table->string('category_color', 20)->default('primary'); // Color for UI
            $table->boolean('category_visible')->default(true); // Visibility status
            $table->timestamp('category_created')->useCurrent();
            $table->timestamp('category_updated')->useCurrent()->useCurrentOnUpdate();
            
            // Foreign key constraint
            $table->foreign('category_creatorid')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
